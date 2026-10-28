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

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $email = $request->input('email', '');
    $password = $request->input('password', '');

    // Ambil data resmi dari tabel users MySQL
    $dbUser = \App\Models\User::where('email', $email)->first();

    if ($dbUser) {
        // Data dari database (id, email, name, role)
        session([
            'user' => [
                'id'       => $dbUser->id,
                'name'     => $dbUser->name,
                'email'    => $dbUser->email,
                'avatar'   => '',
                'provider' => 'local',
                'role'     => $dbUser->role ?? 'user',
            ]
        ]);
    } else {
        // Buat record user baru di database jika belum ada
        $name = ucfirst(explode('@', $email)[0]);
        $role = str_contains(strtolower($email), 'admin') ? 'admin' : 'user';
        $newUser = \App\Models\User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => \Illuminate\Support\Facades\Hash::make($password ?: 'password123'),
            'role'     => $role,
        ]);

        session([
            'user' => [
                'id'       => $newUser->id,
                'name'     => $name,
                'email'    => $email,
                'avatar'   => '',
                'provider' => 'local',
                'role'     => $role,
            ]
        ]);
    }

    return redirect('/');
});

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', function (Request $request) {
    $name = $request->input('name', 'User');
    $email = $request->input('email', 'user@gmail.com');
    $password = $request->input('password', 'password123');

    // Simpan ke database dengan role 'user'
    $newUser = \App\Models\User::updateOrCreate(
        ['email' => $email],
        [
            'name'     => $name,
            'password' => \Illuminate\Support\Facades\Hash::make($password),
            'role'     => 'user',
        ]
    );

    // Jangan langsung login setelah register; arahkan ke halaman login
    return redirect('/login')->with('success', 'Registrasi berhasil! Silakan masuk.');
});

// ---- Route Autentikasi OAuth Google Resmi (Socialite) ----
Route::get('/auth/google', [\App\Http\Controllers\Auth\SocialiteController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [\App\Http\Controllers\Auth\SocialiteController::class, 'handleGoogleCallback'])->name('auth.google.callback');

Route::get('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    session()->forget('user');
    return redirect('/login')->with('success', 'Anda telah berhasil keluar.');
})->name('logout');

Route::get('/paket-wisata', [PaketWisataController::class, 'index'])->name('paket-wisata');
Route::get('/paket-wisata/{slug}', [PaketWisataController::class, 'show'])->name('paket-wisata.show');
Route::get('/paket-wisata/detail/{slug}', [PaketWisataController::class, 'show'])->name('paket-wisata.detail');

Route::get('/checkout/{slug}', [PaketWisataController::class, 'checkout'])->name('paket-wisata.checkout');
Route::get('/paket-wisata/checkout/{slug}', [PaketWisataController::class, 'checkout']);
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');

// ---- Route: Wishlist API ----
Route::post('/wishlist/toggle', [\App\Http\Controllers\WishlistController::class, 'toggle'])->name('wishlist.toggle');
Route::get('/wishlist/user-ids', [\App\Http\Controllers\WishlistController::class, 'userWishlistIds'])->name('wishlist.userIds');

// ---- Route: Update Profil Akun (Admin & User) ----
Route::post('/profile/update', function (Request $request) {
    $userSession = session('user');
    if (!$userSession || empty($userSession['id'])) {
        return response()->json(['success' => false, 'message' => 'Tidak terautentikasi.'], 401);
    }

    $user = \App\Models\User::find($userSession['id']);
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

    // Bangun data update — sertakan phone hanya jika kolom sudah ada
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
    session(['user' => array_merge($userSession, [
        'name'  => $name,
        'email' => $email,
        'phone' => $phone,
    ])]);

    return response()->json(['success' => true, 'message' => 'Profil berhasil diperbarui!']);
})->name('profile.update');

// ---- Route: /profile (Halaman Profil Pengguna) ----
// Hanya untuk user yang sudah login. Menampilkan profile.blade.php.
Route::get('/profile', function () {
    $userSession = session('user');
    if (!$userSession) {
        return redirect('/login')->with('error', 'Silakan masuk terlebih dahulu.');
    }

    // Ambil data resmi dari MySQL berdasarkan id atau email di session
    $dbUser = null;
    if (!empty($userSession['id'])) {
        $dbUser = \App\Models\User::find($userSession['id']);
    }
    if (!$dbUser && !empty($userSession['email'])) {
        $dbUser = \App\Models\User::where('email', $userSession['email'])->first();
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
});

// ---- Route: /dashboard (alias /profile) ----
Route::get('/dashboard', function () {
    return redirect()->route('profile');
})->name('dashboard');

// ---- Route: /user-profile (legacy redirect) ----
Route::get('/user-profile', function () {
    return redirect()->route('profile');
})->name('user-profile');
