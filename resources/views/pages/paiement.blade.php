@extends('layouts.app')

@section('title', 'Billetterie - Jade Birthday 23 - Bellini Fest')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="payment-container">
                <div class="text-center mb-5">
                    <h1 class="festival-title mb-4">BILLET</h1>
                    <p class="lead">Réserve ta place pour l'événement !</p>
                </div>

                <div class="ticket-card">
                    <div class="ticket-header">
                        <div class="ticket-header-bg"></div>
                        <div class="ticket-header-content">
                            <h3>THE 23 BELLINI FEST</h3>
                            <p class="mb-0">14 Mars 2026 - Plan Bateau de Folie</p>
                            <p class="mb-0">(aucun remboursement ne sera effectué)</p>
                        </div>
                    </div>
                    
                    <form action="{{ route('payment.redirect') }}" method="POST">
                        @csrf
                        <div class="ticket-body">
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            
                            <div class="ticket-item mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5>Informations du billet</h5>
                                    <span class="badge bg-danger">30€</span>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Prénom</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nom</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-danger btn-lg px-5">
                                    <i class="bi bi-lock me-2"></i>Réserver et payer sur Stripe
                                </button>
                                <p class="mt-3 small text-muted">
                                    Après validation, vous serez redirigé vers notre page de paiement sécurisée.
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Container principal */
.payment-container {
    background: var(--glass);
    backdrop-filter: blur(20px);
    border: 1px solid var(--glass-border);
    border-radius: 40px;
    padding: 40px;
    box-shadow: var(--shadow);
    position: relative;
    overflow: hidden;
}

/* Carte de billet */
.ticket-card {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease;
}

.ticket-card:hover {
    transform: translateY(-5px);
}

.ticket-header {
    position: relative;
    padding: 30px;
    text-align: center;
    color: white;
    overflow: hidden;
}

.ticket-header-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #FF6A88, #FF9A8A);
    z-index: 1;
}

.ticket-header-content {
    position: relative;
    z-index: 2;
}

.ticket-header h3 {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 10px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.ticket-dots {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.ticket-dots span {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    margin: 0 5px;
}

.ticket-body {
    padding: 30px;
    background: rgba(0, 0, 0, 0.3);
}

.ticket-item {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 15px;
    padding: 20px;
    position: relative;
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.ticket-item:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-3px);
}

.payment-methods {
    margin: 20px 0;
}

.payment-options {
    display: flex;
    gap: 15px;
    margin-top: 10px;
}

.payment-option {
    flex: 1;
    cursor: pointer;
}

.payment-option input[type="radio"] {
    display: none;
}

.payment-option-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 15px;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid transparent;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.payment-option input[type="radio"]:checked + .payment-option-content {
    background: rgba(255, 106, 136, 0.2);
    border-color: var(--rose);
}

.payment-option-content i {
    font-size: 1.5rem;
}

.price-display {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 15px 0;
    padding: 10px 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.price-label {
    font-size: 1.1rem;
}

.price-value {
    font-size: 1.3rem;
    font-weight: bold;
    color: var(--rose);
}

#stripe-form-container {
    min-height: 200px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
}

#card-element {
    padding: 10px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
}

#loading-indicator {
    text-align: center;
    padding: 20px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 10px;
}

.form-control {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid var(--glass-border);
    color: white;
    border-radius: 10px;
    padding: 12px 15px;
}

.form-control:focus {
    background: rgba(255, 255, 255, 0.15);
    border-color: var(--rose);
    color: white;
    box-shadow: 0 0 0 0.25rem rgba(255, 106, 136, 0.25);
}

.form-label {
    color: rgba(255, 255, 255, 0.9);
    font-weight: 500;
    margin-bottom: 8px;
}

.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

#error-message {
    position: fixed;
    top: 20px;
    right: 20px;
    max-width: 400px;
    z-index: 1000;
    border-radius: 10px;
}

/* Responsive */
@media (max-width: 768px) {
    .payment-options {
        flex-direction: column;
    }
    
    .payment-option {
        margin-bottom: 10px;
    }
}
</style>
@endpush

