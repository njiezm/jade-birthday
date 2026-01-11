@extends('layouts.app')

@section('title', 'Paiement réussi - Jade Birthday 23 - Bellini Fest')

@section('floating-assets')
    <x-floating-asset class="asset-bellini-1" svg="bellini.png"/>
    <x-floating-asset class="asset-smirnoff-1" svg="smirnoffB.png"/>
    <x-floating-asset class="asset-glass-1" svg="coupe-martini.png"/>
    <x-floating-asset class="asset-balloon-1" svg="ballon-rose.png"/>
    <x-floating-asset class="asset-star-1" svg="etoile.png"/>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="success-container">
                <div class="text-center mb-5">
                    <div class="success-icon mb-4">
                        <div class="success-circle">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                    <h1 class="festival-title mb-4">PAIEMENT RÉUSSI</h1>
                    <p class="lead">Vos billets pour THE 23 BELLINI FEST sont confirmés!</p>
                    
                    <!-- Éléments décoratifs -->
                    <div class="success-decoration">
                        <div class="decoration-item decoration-1">
                            <i class="fas fa-cocktail"></i>
                        </div>
                        <div class="decoration-item decoration-2">
                            <i class="fas fa-music"></i>
                        </div>
                        <div class="decoration-item decoration-3">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                
                <div class="order-summary">
                    <h3 class="mb-4">Récapitulatif de la commande</h3>
                    
                    <div class="order-details">
                        <div class="detail-row">
                            <span>Référence:</span>
                            <span>{{ $order->reference }}</span>
                        </div>
                        <div class="detail-row">
                            <span>Email:</span>
                            <span>{{ $order->email }}</span>
                        </div>
                        <div class="detail-row">
                            <span>Nombre de billets:</span>
                            <span>{{ $order->tickets->count() }}</span>
                        </div>
                        <div class="detail-row">
                            <span>Prix par billet:</span>
                            <span>35€</span>
                        </div>
                        <div class="detail-row">
                            <span>Statut:</span>
                            <span class="badge bg-success">{{ $order->status }}</span>
                        </div>
                        <div class="detail-row">
                            <span>Montant total:</span>
                            <span>{{ $order->amount }}€</span>
                        </div>
                    </div>
                    
                    <h4 class="mt-4 mb-3">Vos Billets</h4>
                    
                    <div class="tickets-list">
                        @foreach($order->tickets as $ticket)
                        <div class="ticket-item">
                            <div class="ticket-info">
                                <h5>{{ $ticket->firstname }} {{ $ticket->lastname }}</h5>
                                <p>Billet pour THE 23 BELLINI FEST - 35€</p>
                            </div>
                            <div class="ticket-qr">
                                <img src="{{ asset($ticket->qr_code_path) }}" alt="QR Code" class="qr-code">
                                <a href="{{ route('ticket.download', $ticket->id) }}" 
                                   class="btn btn-danger btn-sm mt-2 w-100">
                                   <i class="fas fa-file-pdf me-2"></i>Télécharger le Billet (PDF)
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="text-center mt-4">
                        <p class="mb-3">Les billets ont été envoyés à votre adresse email.</p>
                        <a href="{{ route('home') }}" class="btn btn-outline-light">
                            <i class="fas fa-home me-2"></i>Retour à l'accueil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Container principal */
.success-container {
    background: var(--glass);
    backdrop-filter: blur(20px);
    border: 1px solid var(--glass-border);
    border-radius: 40px;
    padding: 40px;
    box-shadow: var(--shadow);
    position: relative;
    overflow: hidden;
}

/* Icône de succès */
.success-icon {
    position: relative;
    display: inline-block;
}

.success-circle {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4CAF50, #8BC34A);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2.5rem;
    box-shadow: 0 10px 20px rgba(76, 175, 80, 0.3);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
        box-shadow: 0 10px 20px rgba(76, 175, 80, 0.3);
    }
    50% {
        transform: scale(1.05);
        box-shadow: 0 10px 30px rgba(76, 175, 80, 0.5);
    }
    100% {
        transform: scale(1);
        box-shadow: 0 10px 20px rgba(76, 175, 80, 0.3);
    }
}

/* Décorations */
.success-decoration {
    position: relative;
    height: 60px;
    margin-top: 20px;
}

.decoration-item {
    position: absolute;
    font-size: 1.5rem;
    color: rgba(255, 255, 255, 0.7);
    animation: float 3s infinite ease-in-out;
}

.decoration-1 {
    left: 20%;
    top: 0;
    animation-delay: 0s;
}

.decoration-2 {
    left: 50%;
    top: 10px;
    animation-delay: 1s;
}

.decoration-3 {
    right: 20%;
    top: 5px;
    animation-delay: 2s;
}

@keyframes float {
    0% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
    100% {
        transform: translateY(0);
    }
}

/* Récapitulatif de commande */
.order-summary {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.order-details {
    margin-bottom: 20px;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.detail-row:last-child {
    border-bottom: none;
    font-weight: bold;
    font-size: 1.2rem;
    margin-top: 10px;
    padding-top: 15px;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
}

/* Liste des billets */
.tickets-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.ticket-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 15px;
    padding: 20px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.ticket-item:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-3px);
}

.ticket-qr .qr-code {
    width: 80px;
    height: 80px;
    border-radius: 10px;
    overflow: hidden;
}

/* Responsive */
@media (max-width: 768px) {
    .ticket-item {
        flex-direction: column;
        text-align: center;
    }
    
    .ticket-qr {
        margin-top: 15px;
    }
}
</style>
@endpush