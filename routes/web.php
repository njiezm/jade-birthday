<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\TicketController; 
use App\Http\Controllers\MessageController;

// Page d'accueil
Route::get('/', fn() => view('pages.home'))->name('home');

// Routes pour la billetterie
//Route::get('/billetterie', fn() => view('pages.paiement'))->name('billetterie');
//Route::get('/paiement', fn() => view('pages.paiement'))->name('paiement');
//Route::post('/paiement', [PaymentController::class, 'store'])->name('paiement.store');
//Route::get('/paiement/success/{reference}', [PaymentController::class, 'success'])->name('paiement.success');

// Routes pour la billetterie et les paiements
Route::get('/billetterie', function () {
    return view('pages.paiement');
})->name('billetterie');

Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/payment/success/{reference}', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/cancel/{reference}', [PaymentController::class, 'cancel'])->name('payment.cancel');
Route::get('/stripe/success/{reference}', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
Route::get('/stripe/cancel/{reference}', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');
Route::get('/paiement/success/{reference}', [PaymentController::class, 'paymentSuccess'])->name('paiement.success');




// Page du formulaire de billetterie
Route::get('/billetterie', [PaymentController::class, 'showForm'])->name('billetterie');

// Route qui reçoit le formulaire et redirige vers Stripe
Route::post('/payment/redirect', [PaymentController::class, 'redirectToPayment'])->name('payment.redirect');

// Page de succès après paiement (vers où Stripe redirige le client)
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

// Routes pour les billets
Route::get('/ticket/validate/{reference}/{id}', [TicketController::class, 'validate'])->name('ticket.validate');
Route::get('/ticket/download/{id}', [TicketController::class, 'downloadPdf'])->name('ticket.download');


// Routes pour la validation et le téléchargement des billets
Route::get('/ticket/validate/{reference}/{id}', [TicketController::class, 'validate'])->name('ticket.validate');
Route::get('/ticket/download/{ticket}', [TicketController::class, 'downloadPdf'])->name('ticket.download');

// Routes pour la wishlist
Route::get('/urne', fn() => view('pages.wishlist'))->name('urne');
// Routes pour la wishlist
Route::get('/wishlist', function () {
    return view('pages.wishlist');
})->name('wishlist');
Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
Route::get('/wishlist/success/{reference}', [WishlistController::class, 'success'])->name('wishlist.success');
Route::get('/wishlist/cancel/{reference}', [WishlistController::class, 'cancel'])->name('wishlist.cancel');

// Routes pour la galerie
Route::get('/galerie', [GalleryController::class, 'index'])->name('galerie');
Route::post('/galerie', [GalleryController::class, 'store'])->name('galerie.store');


// Autres pages (à créer plus tard)
Route::get('/infos', fn() => view('pages.infos'))->name('infos');
Route::get('/livre-d-or', fn() => view('pages.livre-d-or'))->name('livre-d-or');
Route::get('/jeux', fn() => view('pages.jeux'))->name('jeux');



// Routes pour les messages du mur
Route::get('/api/messages', [MessageController::class, 'index']);
Route::post('/api/messages', [MessageController::class, 'store']);