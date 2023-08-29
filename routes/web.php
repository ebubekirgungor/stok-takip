<?php

use App\Http\Controllers\ayarlar;
use App\Http\Controllers\birim;
use App\Http\Controllers\depo;
use App\Http\Controllers\firma;
use App\Http\Controllers\islem_tipi;
use App\Http\Controllers\sayim;
use App\Http\Controllers\stok;
use App\Http\Controllers\stok_cikisi;
use App\Http\Controllers\stok_girisi;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/giris');
});

Route::resource('genel', 'App\Http\Controllers\genel')->middleware(['auth', 'verified']);

Route::resource('stoklar', 'App\Http\Controllers\stok')->middleware(['auth', 'verified']);
								
Route::resource('firmalar', 'App\Http\Controllers\firma')->middleware(['auth', 'verified']);

Route::resource('islem_tipleri', 'App\Http\Controllers\islem_tipi')->middleware(['auth', 'verified']);

Route::resource('depolar', 'App\Http\Controllers\depo')->middleware(['auth', 'verified']);

Route::resource('birimler', 'App\Http\Controllers\birim')->middleware(['auth', 'verified']);

Route::resource('stok-girisi', 'App\Http\Controllers\stok_girisi')->middleware(['auth', 'verified']);

Route::resource('stok-cikisi', 'App\Http\Controllers\stok_cikisi')->middleware(['auth', 'verified']);

Route::resource('stok-sayimlari', 'App\Http\Controllers\sayim')->middleware(['auth', 'verified']);

Route::get('/analiz-raporlar', function () {
    return view('sayfalar.analiz-raporlar');
})->middleware(['auth', 'verified'])->name('analiz-raporlar');

Route::resource('ayarlar', 'App\Http\Controllers\ayarlar')->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
