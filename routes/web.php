<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PricelistController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\TestimoniController;
use Illuminate\Support\Facades\Route;

// ── Frontend Routes ──────────────────────────────
Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');
Route::get('/pricelist', [PricelistController::class, 'index'])->name('pricelist');
Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel');
Route::get('/artikel/{artikel}', [ArtikelController::class, 'show'])->name('artikel.show');

