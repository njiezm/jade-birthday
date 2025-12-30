@extends('layouts.app')

@section('title', 'Billetterie - Jade Birthday 23 - Bellini Fest')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="payment-container">
                <div class="text-center mb-5">
                    <h1 class="festival-title mb-4">BILLETS</h1>
                    <p class="lead">Réservez votre place pour le festival du siècle!</p>
                </div>
                
                <!-- Afficher les messages d'erreur -->
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                
                <div class="ticket-card">
                    <div class="ticket-header">
                        <h3>THE 23 BELLINI FEST</h3>
                        <p class="mb-0">14 Mars 2026 - Plan Bateau de Folie</p>
                    </div>
                    
                    <form id="payment-form">
                        @csrf
                        <div class="ticket-body">
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            
                            <div id="tickets-container">
                                <div class="ticket-item mb-4" data-ticket-index="0">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5>Billet 1</h5>
                                        <span class="badge bg-danger">35€</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Prénom</label>
                                            <input type="text" class="form-control ticket-firstname" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nom</label>
                                            <input type="text" class="form-control ticket-lastname" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-4">
                                <button type="button" id="add-ticket" class="btn btn-outline-light">
                                    <i class="bi bi-plus-circle me-2"></i>Ajouter un billet
                                </button>
                                <div class="total-price">
                                    Total: <span id="total-amount">35€</span>
                                </div>
                            </div>
                            
                            <!-- Options de paiement -->
                            <div class="payment-methods mt-4">
                                <h4>Méthode de paiement</h4>
                                <div class="payment-options">
                                    <label class="payment-option">
                                        <input type="radio" name="payment_method" value="paypal" checked>
                                        <div class="payment-option-content">
                                            <i class="fab fa-paypal"></i>
                                            <span>PayPal</span>
                                        </div>
                                    </label>
                                    <label class="payment-option">
                                        <input type="radio" name="payment_method" value="stripe">
                                        <div class="payment-option-content">
                                            <i class="fab fa-stripe"></i>
                                            <span>Carte bancaire (Stripe)</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Prix affiché -->
                            <div class="price-display">
                                <span class="price-label">Prix par billet:</span>
                                <span class="price-value">35€</span>
                            </div>
                            
                            <div class="text-center mt-4">
                                <!-- Conteneur pour les boutons de paiement -->
                                <div id="paypal-button-container" class="mb-3"></div>
                                <button type="submit" id="submit-button" class="btn btn-danger btn-lg px-5" style="display: none;">
                                    <i class="bi bi-lock me-2"></i>Payer maintenant
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Message d'erreur pour le débogage -->
<div id="error-message" class="alert alert-danger" style="display: none;"></div>

<script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.' . config('paypal.mode') . '.client_id') }}&currency=EUR&intent=capture"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let ticketCount = 1;
        const ticketPrice = 35;
        let paypalButtonsRendered = false;
        
        // Récupérer le token CSRF
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                          document.querySelector('input[name="_token"]')?.value;
        
        // Afficher les erreurs
        function showError(message) {
            const errorDiv = document.getElementById('error-message');
            errorDiv.textContent = message;
            errorDiv.style.display = 'block';
            
            // Masquer après 5 secondes
            setTimeout(() => {
                errorDiv.style.display = 'none';
            }, 5000);
        }
        
        // Gestion de l'ajout de billets
        document.getElementById('add-ticket').addEventListener('click', function() {
            ticketCount++;
            const ticketsContainer = document.getElementById('tickets-container');
            
            const newTicket = document.createElement('div');
            newTicket.className = 'ticket-item mb-4';
            newTicket.setAttribute('data-ticket-index', ticketCount - 1);
            newTicket.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>Billet ${ticketCount}</h5>
                    <span class="badge bg-danger">35€</span>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-ticket">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" class="form-control ticket-firstname" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control ticket-lastname" required>
                    </div>
                </div>
            `;
            
            ticketsContainer.appendChild(newTicket);
            updateTotalPrice();
            
            // Gestion de la suppression de billet
            newTicket.querySelector('.remove-ticket').addEventListener('click', function() {
                newTicket.remove();
                updateTotalPrice();
                reindexTickets();
            });
        });
        
        // Réindexer les billets après suppression
        function reindexTickets() {
            const tickets = document.querySelectorAll('.ticket-item');
            tickets.forEach((ticket, index) => {
                ticket.setAttribute('data-ticket-index', index);
                const title = ticket.querySelector('h5');
                if (title) {
                    title.textContent = `Billet ${index + 1}`;
                }
            });
            ticketCount = tickets.length;
        }
        
        // Mise à jour du prix total
        function updateTotalPrice() {
            const tickets = document.querySelectorAll('.ticket-item').length;
            const total = tickets * ticketPrice;
            document.getElementById('total-amount').textContent = total + '€';
        }
        
        // Collecter les données des billets
        function collectTicketData() {
            const tickets = [];
            document.querySelectorAll('.ticket-item').forEach((item) => {
                const firstname = item.querySelector('.ticket-firstname').value;
                const lastname = item.querySelector('.ticket-lastname').value;
                if (firstname && lastname) {
                    tickets.push({ firstname, lastname });
                }
            });
            return tickets;
        }
        
        // Gestion du changement de méthode de paiement
        document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const paypalContainer = document.getElementById('paypal-button-container');
                const submitButton = document.getElementById('submit-button');
                
                if (this.value === 'paypal') {
                    paypalContainer.style.display = 'block';
                    submitButton.style.display = 'none';
                    
                    // Render PayPal buttons only once
                    if (!paypalButtonsRendered) {
                        renderPayPalButtons();
                        paypalButtonsRendered = true;
                    }
                } else {
                    paypalContainer.style.display = 'none';
                    submitButton.style.display = 'inline-block';
                }
            });
        });
        
        // Configuration du bouton PayPal
        function renderPayPalButtons() {
            paypal.Buttons({
                createOrder: function(data, actions) {
                    const email = document.getElementById('email').value;
                    const tickets = collectTicketData();
                    
                    if (!email || tickets.length === 0) {
                        showError('Veuillez remplir tous les champs');
                        return;
                    }
                    
                    // Envoyer la requête au serveur
                    return fetch('/payment/store', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            email: email,
                            payment_method: 'paypal',
                            tickets: tickets
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            // Si la réponse n'est pas OK, essayer de récupérer le message d'erreur
                            return response.text().then(text => {
                                throw new Error('Erreur serveur: ' + text);
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            return data.orderID;
                        } else {
                            throw new Error(data.message || 'Erreur lors de la création de la commande PayPal');
                        }
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        showError('Erreur PayPal: ' + error.message);
                        throw error;
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        // Rediriger vers la page de succès
                        window.location.href = '/payment/success/' + details.purchase_units[0].reference_id;
                    });
                },
                onError: function(err) {
                    console.error('Erreur PayPal:', err);
                    showError('Une erreur est survenue lors du paiement PayPal.');
                }
            }).render('#paypal-button-container');
        }
        
        // Gestion de la soumission du formulaire pour Stripe
        document.getElementById('payment-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
            
            if (paymentMethod === 'paypal') {
                return; // PayPal gère déjà la soumission
            }
            
            const email = document.getElementById('email').value;
            const tickets = collectTicketData();
            
            if (!email || tickets.length === 0) {
                showError('Veuillez remplir tous les champs');
                return;
            }
            
            // Afficher un indicateur de chargement
            const submitButton = document.getElementById('submit-button');
            const originalText = submitButton.innerHTML;
            submitButton.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Chargement...';
            submitButton.disabled = true;
            
            // Envoyer la requête au serveur pour Stripe
            fetch('/payment/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    email: email,
                    payment_method: 'stripe',
                    tickets: tickets
                })
            })
            .then(response => {
                if (!response.ok) {
                    // Si la réponse n'est pas OK, essayer de récupérer le message d'erreur
                    return response.text().then(text => {
                        throw new Error('Erreur serveur: ' + text);
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Rediriger vers Stripe Checkout
                    window.location.href = data.redirect_url;
                } else {
                    showError('Erreur: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showError('Une erreur est survenue. Veuillez réessayer.');
            })
            .finally(() => {
                // Restaurer le bouton
                submitButton.innerHTML = originalText;
                submitButton.disabled = false;
            });
        });
        
        // Initialiser l'affichage
        updateTotalPrice();
        
        // Déclencher le changement pour afficher PayPal par défaut
        document.querySelector('input[name="payment_method"]:checked').dispatchEvent(new Event('change'));
    });
</script>
@endsection

@push('styles')
<style>
.payment-container {
    background: var(--glass);
    backdrop-filter: blur(20px);
    border: 1px solid var(--glass-border);
    border-radius: 40px;
    padding: 40px;
    box-shadow: var(--shadow);
}

.ticket-card {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    overflow: hidden;
}

.ticket-header {
    background: linear-gradient(135deg, var(--peach), var(--rose));
    padding: 20px;
    text-align: center;
}

.ticket-body {
    padding: 30px;
}

.ticket-item {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 15px;
    padding: 20px;
    position: relative;
}

.remove-ticket {
    position: absolute;
    top: 10px;
    right: 10px;
}

.total-price {
    font-size: 1.2rem;
    font-weight: bold;
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

#paypal-button-container {
    min-height: 45px;
}

.form-control {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid var(--glass-border);
    color: white;
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
}
</style>
@endpush