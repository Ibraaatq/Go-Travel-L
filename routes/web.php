<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaketWisataController;
use App\Http\Controllers\DestinasiController;

Route::get('/', function () {
    $allPaket = PaketWisataController::getPaketData();
    // Ambil 4 paket populer utama (Jogja, Bandung, Bali, Lampung)
    $popularSlugs = ['jogja', 'bandung', 'bali', 'lampung'];
    $popularPaket = [];
    foreach ($popularSlugs as $slug) {
        if (isset($allPaket[$slug])) {
            $popularPaket[] = $allPaket[$slug];
        }
    }
    return view('home', compact('popularPaket'));
});

Route::get('/destinasi', [DestinasiController::class, 'index'])->name('destinasi.index');
Route::get('/destinasi/{slug}', [DestinasiController::class, 'show'])->name('destinasi.show');

Route::get('/about', function () {
    return view('about');
})->name('about');

use Illuminate\Http\Request;

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $email = $request->input('email', 'user@gmail.com');
    $password = $request->input('password', '');
    $dbUser = \App\Models\User::where('email', $email)->first();

    if ($dbUser) {
        $name = $dbUser->name;
        $role = $dbUser->role ?? 'user';
    } else {
        $name = explode('@', $email)[0];
        $role = 'user';
        if (str_contains(strtolower($email), 'admin') || str_contains(strtolower($name), 'admin') || str_contains(strtolower($email), 'sasa') || str_contains(strtolower($name), 'sasa') || str_contains(strtolower($email), 'ika')) {
            $role = 'admin';
        }
    }

    session([
        'user' => [
            'name' => ucfirst($name),
            'email' => $email,
            'avatar' => '',
            'provider' => 'local',
            'role' => $role,
        ]
    ]);
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
    \App\Models\User::updateOrCreate(
        ['email' => $email],
        [
            'name' => $name,
            'password' => \Illuminate\Support\Facades\Hash::make($password),
            'role' => 'user',
        ]
    );

    session([
        'user' => [
            'name' => $name,
            'email' => $email,
            'avatar' => '',
            'provider' => 'local',
            'role' => 'user',
        ]
    ]);
    return redirect('/login')->with('success', 'Registrasi berhasil! Silakan masuk.');
});

Route::get('/auth/google', function () {
    return redirect('/login');
})->name('auth.google');

Route::post('/auth/google/select', function (Request $request) {
    $name = $request->input('name', 'Google User');
    $email = $request->input('email', 'user@gmail.com');
    $avatar = $request->input('avatar', '');

    session([
        'user' => [
            'name' => $name,
            'email' => $email,
            'avatar' => $avatar,
            'provider' => 'google',
            'role' => 'user',
        ]
    ]);

    return redirect('/')->with('success', 'Selamat datang, ' . $name . '! Berhasil masuk dengan Google.');
})->name('auth.google.select');

Route::get('/auth/facebook', function () {
    session([
        'user' => [
            'name' => 'Facebook User',
            'email' => 'user@facebook.com',
            'avatar' => '',
            'provider' => 'facebook',
            'role' => 'user',
        ]
    ]);
    return redirect('/')->with('success', 'Berhasil masuk dengan Facebook!');
})->name('auth.facebook');

Route::get('/logout', function () {
    session()->forget('user');
    return redirect('/login')->with('success', 'Anda telah berhasil keluar.');
})->name('logout');

Route::get('/paket-wisata', [PaketWisataController::class, 'index'])->name('paket-wisata.index');
Route::get('/paket-wisata/{slug}', [PaketWisataController::class, 'show'])->name('paket-wisata.show');
Route::get('/paket-wisata/detail/{slug}', [PaketWisataController::class, 'show'])->name('paket-wisata.detail');

Route::get('/checkout/{slug}', [PaketWisataController::class, 'checkout'])->name('paket-wisata.checkout');
Route::get('/paket-wisata/checkout/{slug}', [PaketWisataController::class, 'checkout']);

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/dashboard', function () {
    return view('profile');
})->name('dashboard');

Route::get('/admin', function () {
    return view('profile');
})->name('admin');
