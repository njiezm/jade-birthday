@extends('layouts.app')

@section('title', 'Paiement Réussi !')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="payment-container text-center">
                <div class="mb-4">
                    <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                </div>
                <h1 class="festival-title mb-4">Paiement Validé !</h1>
                <p class="lead mb-4">
                    Merci pour votre achat ! Votre billet pour le <strong>THE 23 BELLINI FEST</strong> a été validé.
                </p>
                <p class="mb-4">
                    Un email contenant votre billet vient de vous être envoyé à l'adresse <strong>{{ $order->email }}</strong>.
                    <br>Pensez à vérifier vos courriers indésirables.
                </p>
                <p class="mb-5">
                    <strong>Votre référence de commande :</strong> <span class="badge bg-info">{{ $order->reference }}</span>
                </p>
                
                <a href="{{ route('billetterie') }}" class="btn btn-outline-light">
                    <i class="bi bi-arrow-left me-2"></i>Retour à l'accueil
                </a>
            </div>
        </div>
    </div>
</div>
@endsection