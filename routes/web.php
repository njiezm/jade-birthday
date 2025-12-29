<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\GalleryController;

Route::get('/', fn() => view('pages.home'))->name('home');

Route::get('/paiement', fn() => view('pages.paiement'))->name('paiement');
Route::post('/paiement', [PaymentController::class, 'store']);

Route::get('/wishlist', fn() => view('pages.wishlist'))->name('wishlist');
Route::post('/wishlist', [WishlistController::class, 'store']);

Route::get('/galerie', fn() => view('pages.galerie'))->name('galerie');
Route::post('/galerie', [GalleryController::class, 'store']);
