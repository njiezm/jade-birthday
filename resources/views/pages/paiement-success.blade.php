@extends('layouts.app')

@section('title', 'Paiement réussi - Jade Birthday 23 - Bellini Fest')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="success-container">
                <div class="text-center mb-5">
                    <div class="success-icon mb-4">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h1 class="festival-title mb-4">PAIEMENT RÉUSSI</h1>
                    <p class="lead">Vos billets pour THE 23 BELLINI FEST sont confirmés!</p>
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
                                <!-- BOUTON DE TÉLÉCHARGEMENT PDF -->
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
.success-container {
    background: var(--glass);
    backdrop-filter: blur(20px);
    border: 1px solid var(--glass-border);
    border-radius: 40px;
    padding: 40px;
    box-shadow: var(--shadow);
}

.success-icon {
    font-size: 5rem;
    color: #4CAF50;
}

.order-summary {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 30px;
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
}

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
}

.ticket-qr .qr-code {
    width: 80px;
    height: 80px;
}
</style>
@endpush