<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaketWisataController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

use App\Models\Package;

Route::get('/', function () {
    $popularPackages = Package::latest()->take(4)->get();
    return view('home', compact('popularPackages'));
})->name('home');

Route::get('/destinasi', [DestinasiController::class, 'index'])->name('destinasi');
Route::get('/destinasi/{slug}', [DestinasiController::class, 'show'])->name('destinasi.show');

Route::get('/about', function () {
    return view('about');
})->name('about');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// ---- Route Autentikasi Pengguna (Guest Only) ----
Route::middleware('guest.user')->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/login', function (Request $request) {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Alamat email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Cari user resmi di database
        $dbUser = \App\Models\User::where('email', $credentials['email'])->first();

        if (!$dbUser) {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->with('error', 'Akun dengan email tersebut tidak ditemukan. Silakan daftar terlebih dahulu.');
        }

        // Jika akun terdaftar lewat Google OAuth dan belum memiliki password
        if (empty($dbUser->password) && $dbUser->provider === 'google') {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->with('error', 'Akun ini terdaftar melalui Google. Silakan masuk menggunakan tombol Google.');
        }

        // Verifikasi password hash
        if (!Hash::check($credentials['password'], $dbUser->password)) {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->with('error', 'Password yang Anda masukkan salah.');
        }

        // Simpan sesi login resmi ke Laravel Auth & session
        Auth::login($dbUser, $request->boolean('remember'));
        $request->session()->regenerate();

        session([
            'user' => [
                'id'       => $dbUser->id,
                'name'     => $dbUser->name,
                'email'    => $dbUser->email,
                'avatar'   => $dbUser->avatar ?: '',
                'provider' => $dbUser->provider ?: 'local',
                'role'     => $dbUser->role ?? 'user',
                'phone'    => $dbUser->phone ?? '',
            ]
        ]);

        if ($dbUser->role === 'admin') {
            return redirect()->route('admin')->with('success', 'Selamat datang kembali, Admin ' . $dbUser->name . '!');
        }

        return redirect('/')->with('success', 'Selamat datang kembali, ' . $dbUser->name . '!');
    });

    Route::get('/register', function () {
        return view('register');
    })->name('register');

    Route::post('/register', function (Request $request) {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required'      => 'Nama lengkap wajib diisi.',
            'email.required'     => 'Alamat email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email ini sudah terdaftar. Silakan masuk.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        \App\Models\User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'user',
            'provider' => 'local',
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan masuk dengan akun baru Anda.');
    });

    // ---- Route Autentikasi OAuth Google Resmi (Socialite) ----
    Route::get('/auth/google', [\App\Http\Controllers\Auth\SocialiteController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [\App\Http\Controllers\Auth\SocialiteController::class, 'handleGoogleCallback'])->name('auth.google.callback');

    // ---- Route Lupa / Reset Password ----
    Route::get('/forgot-password', function () {
        return view('forgot-password');
    })->name('password.request');

    Route::get('/lupa-password', function () {
        return view('forgot-password');
    });

    Route::post('/forgot-password', function (Request $request) {
        $validated = $request->validate([
            'email'                 => 'required|email',
            'password'              => 'required|string|min:6|confirmed',
        ], [
            'email.required'        => 'Alamat email wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
            'password.required'     => 'Password baru wajib diisi.',
            'password.min'          => 'Password minimal harus 6 karakter.',
            'password.confirmed'    => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = \App\Models\User::where('email', $validated['email'])->first();

        if (!$user) {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->with('error', 'Akun dengan alamat email tersebut tidak ditemukan.');
        }

        // Update password hash user
        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect('/login')->with('success', 'Password Anda berhasil diperbarui! Silakan masuk dengan password baru.');
    })->name('password.update');
});

// ---- Route Logout (GET & POST) ----
Route::match(['get', 'post'], '/logout', function (Request $request) {
    Auth::logout();
    $request->session()->forget('user');
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login')->with('success', 'Anda telah berhasil keluar.');
})->name('logout');

Route::get('/paket-wisata', [PaketWisataController::class, 'index'])->name('paket-wisata');
Route::get('/paket-wisata/{slug}', [PaketWisataController::class, 'show'])->name('paket-wisata.show');
Route::get('/paket-wisata/detail/{slug}', [PaketWisataController::class, 'show'])->name('paket-wisata.detail');

Route::get('/checkout/{slug}', [PaketWisataController::class, 'checkout'])->name('paket-wisata.checkout');
Route::get('/paket-wisata/checkout/{slug}', [PaketWisataController::class, 'checkout']);
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/contact', function () {
    return redirect('/#contact');
})->name('contact');
Route::get('/kontak', function () {
    return redirect('/#contact');
})->name('kontak');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');

// ---- Route: Wishlist API ----
Route::post('/wishlist/toggle', [\App\Http\Controllers\WishlistController::class, 'toggle'])->name('wishlist.toggle');
Route::get('/wishlist/user-ids', [\App\Http\Controllers\WishlistController::class, 'userWishlistIds'])->name('wishlist.userIds');

// ---- Route: User Profile (Dilindungi Middleware auth.user) ----
Route::middleware('auth.user')->group(function () {
    Route::post('/profile/update', function (Request $request) {
        $userSession = session('user');
        $userId = Auth::id() ?? ($userSession['id'] ?? null);

        $user = \App\Models\User::find($userId);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User tidak ditemukan.'], 404);
        }

        $name     = trim($request->input('name', ''));
        $email    = trim($request->input('email', ''));
        $phone    = trim($request->input('phone', ''));
        $password = $request->input('password', '');

        if (!$name || !$email) {
            return response()->json(['success' => false, 'message' => 'Nama dan email wajib diisi.'], 422);
        }

        // Cek email sudah dipakai user lain
        $emailExists = \App\Models\User::where('email', $email)->where('id', '!=', $user->id)->exists();
        if ($emailExists) {
            return response()->json(['success' => false, 'message' => 'Email sudah digunakan akun lain.'], 422);
        }

        // Bangun data update
        $updateData = ['name' => $name, 'email' => $email];

        $hasPhoneColumn = \Illuminate\Support\Facades\Schema::hasColumn('users', 'phone');
        if ($hasPhoneColumn) {
            $updateData['phone'] = $phone;
        }

        if ($password && strlen($password) >= 6) {
            $updateData['password'] = \Illuminate\Support\Facades\Hash::make($password);
        }

        $user->update($updateData);

        // Perbarui session agar langsung terefleksi tanpa logout
        session(['user' => array_merge(session('user', []), [
            'id'    => $user->id,
            'name'  => $name,
            'email' => $email,
            'phone' => $phone,
            'role'  => $user->role,
        ])]);

        return response()->json(['success' => true, 'message' => 'Profil berhasil diperbarui!']);
    })->name('profile.update');

    // Halaman Profil Pengguna
    Route::get('/profile', function () {
        $userId = Auth::id() ?? session('user.id');
        $dbUser = \App\Models\User::find($userId);

        if (!$dbUser && session()->has('user.email')) {
            $dbUser = \App\Models\User::where('email', session('user.email'))->first();
        }

        // Hitung pesanan user
        $userOrders = collect();
        try {
            if ($dbUser) {
                $allUserOrders = \App\Models\Order::where(function($q) use ($dbUser) {
                        $q->where('user_id', $dbUser->id)
                          ->orWhere('email_pemesan', $dbUser->email);
                    })
                    ->latest()
                    ->get();

                // Deduplicate: jika order cocok user_id DAN email, hindari tampil 2x
                $userOrders = $allUserOrders->unique(function ($ord) {
                    return $ord->nama_pemesan
                        . '|' . $ord->nama_paket
                        . '|' . $ord->tanggal_keberangkatan
                        . '|' . $ord->jumlah_peserta
                        . '|' . $ord->total_pembayaran;
                })->values();
            }
        } catch (\Throwable $e) {
            $userOrders = collect();
        }

        // Ambil daftar wishlist user
        $userWishlists = collect();
        try {
            if ($dbUser) {
                $userWishlists = \App\Models\Wishlist::with('package')
                    ->where('user_id', $dbUser->id)
                    ->latest()
                    ->get();
            }
        } catch (\Throwable $e) {
            $userWishlists = collect();
        }

        return view('profile', compact('dbUser', 'userOrders', 'userWishlists'));
    })->name('profile');
});

// ---- Route: /admin (Dashboard Admin) ----
// Dilindungi AdminMiddleware — hanya role 'admin' dari DB yang bisa masuk.
Route::middleware('admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    // Packages CRUD
    Route::post('/admin/packages', [AdminController::class, 'storePackage'])->name('admin.packages.store');
    Route::put('/admin/packages/{id}', [AdminController::class, 'updatePackage'])->name('admin.packages.update');
    Route::post('/admin/packages/{id}/update', [AdminController::class, 'updatePackage'])->name('admin.packages.updatePost');
    Route::delete('/admin/packages/{id}', [AdminController::class, 'destroyPackage'])->name('admin.packages.destroy');

    // Users Management CRUD
    Route::get('/admin/users', [\App\Http\Controllers\AdminUserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users', [\App\Http\Controllers\AdminUserController::class, 'store'])->name('admin.users.store');
    Route::put('/admin/users/{id}', [\App\Http\Controllers\AdminUserController::class, 'update'])->name('admin.users.update');
    Route::patch('/admin/users/{id}/role', [\App\Http\Controllers\AdminUserController::class, 'updateRole'])->name('admin.users.updateRole');
    Route::delete('/admin/users/{id}', [\App\Http\Controllers\AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    // Orders Status Management
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

// ---- Route: /dashboard (alias /profile) ----
Route::get('/dashboard', function () {
    return redirect()->route('profile');
})->name('dashboard');

// ---- Route: /user-profile (legacy redirect) ----
Route::get('/user-profile', function () {
    return redirect()->route('profile');
})->name('user-profile');
