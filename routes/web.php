<?php

use App\Http\Controllers\MyTestContrroller;
use App\Http\Controllers\UniversiteController;
use Illuminate\Support\Facades\Route;

Route::get('refreshData', [MyTestContrroller::class, 'index'])->name('refreshData');


Route::view('/', 'index')->name('home');
Route::view('/donnedddGeted', 'donneesOk')->name('donneesOk');

Route::get('/universites', [UniversiteController::class, 'index'])->name('universites');
Route::get('/universites/{universite}', [UniversiteController::class, 'show'])->name('universites.show');
Route::get('/donnedddGeted', [UniversiteController::class, 'index'])->name('universites');
Route::get('/comparaison', [UniversiteController::class, 'comparaison'])->name('comparaison');