<?php

use App\Http\Controllers\KontaktController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::post('/kontakt', [KontaktController::class, 'send'])->name('kontakt.send');
