<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaketWisataController;
use App\Http\Controllers\DestinasiController;

Route::get('/', function () {
    return view('home');
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
    $name = explode('@', $email)[0];
    session([
        'user' => [
            'name' => ucfirst($name),
            'email' => $email,
            'avatar' => '',
            'provider' => 'local',
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
    session([
        'user' => [
            'name' => $name,
            'email' => $email,
            'avatar' => '',
            'provider' => 'local',
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
