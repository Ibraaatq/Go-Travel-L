<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaketWisataController;

Route::get('/', function () {
    return view('home');
});

Route::get('/paket-wisata', [PaketWisataController::class, 'index'])->name('paket-wisata.index');
Route::get('/paket-wisata/{slug}', [PaketWisataController::class, 'show'])->name('paket-wisata.show');
Route::get('/paket-wisata/detail/{slug}', [PaketWisataController::class, 'show'])->name('paket-wisata.detail');

Route::get('/checkout/{slug}', [PaketWisataController::class, 'checkout'])->name('paket-wisata.checkout');
Route::get('/paket-wisata/checkout/{slug}', [PaketWisataController::class, 'checkout']);
