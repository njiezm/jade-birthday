@extends('layouts.app')

@section('title', 'Billetterie - Jade Birthday 23 - Bellini Fest')

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
            <div class="payment-container">
                <div class="text-center mb-5">
                    <h1 class="festival-title mb-4">BILLETS</h1>
                    <p class="lead">N'attends pas, réserve vite ta place !</p>
                </div>
                
                <!-- Afficher les messages d'erreur -->
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                
                <div class="ticket-card">
                    <div class="ticket-header">
                        <div class="ticket-header-bg"></div>
                        <div class="ticket-header-content">
                            <h3>THE 23 BELLINI FEST</h3>
                            <p class="mb-0">14 Mars 2026 - Plan Bateau de Folie</p>
                            <p class="mb-0">(aucun remboursement ne sera effectué)</p>
                            <br>
                            <br>
                            <div class="ticket-dots">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
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
                                        <span class="badge bg-danger">30€</span>
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
                                    Total: <span id="total-amount">30€</span>
                                </div>
                            </div>
                            
                            <!-- Options de paiement -->
                            <div class="payment-methods mt-4">
                                <h4>Méthode de paiement</h4>
                                <div class="payment-options">
                                    <label class="payment-option">
                                        <input type="radio" name="payment_method" value="sumup" checked>
                                        <div class="payment-option-content">
                                            <i class="fas fa-credit-card"></i>
                                            <span>Carte bancaire (SumUp)</span>
                                        </div>
                                    </label>
                                    <label class="payment-option">
                                        <input type="radio" name="payment_method" value="cash">
                                        <div class="payment-option-content">
                                            <i class="fas fa-money-bill-wave"></i>
                                            <span>Paiement en espèces</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Prix affiché -->
                            <div class="price-display">
                                <span class="price-label">Prix par billet:</span>
                                <span class="price-value">30€</span>
                            </div>
                            
                            <div class="text-center mt-4">
                                <!-- Indicateur de chargement -->
                                <div id="loading-indicator" class="mb-3" style="display: none;">
                                    <div class="spinner-border text-light" role="status">
                                        <span class="visually-hidden">Chargement...</span>
                                    </div>
                                    <p class="mt-2">Traitement en cours...</p>
                                </div>
                                
                                <!-- Conteneur pour le formulaire SumUp -->
                                <div id="sumup-form-container" class="mb-3">
                                    <div id="sumup-card"></div>
                                </div>
                                
                                <!-- Bouton de paiement pour espèces -->
                                <button type="submit" id="submit-button" class="btn btn-danger btn-lg px-5" style="display: none;">
                                    <i class="bi bi-lock me-2"></i>Confirmer la réservation
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

<!-- Script SumUp -->
<script src="https://gateway.sumup.com/gateway/ecom/card/v2/sdk.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let ticketCount = 1;
        const ticketPrice = 30;
        let sumupInstance = null;
        let isProcessingPayment = false; // Pour éviter les soumissions multiples
        
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
                    <span class="badge bg-danger">30€</span>
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
        
        // Afficher/masquer l'indicateur de chargement
        function toggleLoading(show) {
            const loadingIndicator = document.getElementById('loading-indicator');
            const sumupContainer = document.getElementById('sumup-form-container');
            
            if (show) {
                loadingIndicator.style.display = 'block';
                sumupContainer.style.display = 'none';
            } else {
                loadingIndicator.style.display = 'none';
                sumupContainer.style.display = 'block';
            }
        }
        
        // Gestion du changement de méthode de paiement
        document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const sumupContainer = document.getElementById('sumup-form-container');
                const submitButton = document.getElementById('submit-button');
                
                if (this.value === 'sumup') {
                    sumupContainer.style.display = 'block';
                    submitButton.style.display = 'none';
                    
                    // Initialiser SumUp si ce n'est pas déjà fait
                    if (!sumupInstance) {
                        initSumUp();
                    }
                } else {
                    sumupContainer.style.display = 'none';
                    submitButton.style.display = 'inline-block';
                }
            });
        });
        
        // Initialiser SumUp
        function initSumUp() {
            // Configuration SumUp (à remplacer avec vos clés API)
            SumUpCard.mount({
                id: 'sumup-card',
                // Remplacer avec votre clé publique SumUp
                apiKey: 'sup_pk_D9exAU92LHlTqG22V8Rn3etvQH0oq2MyU',
                // Personnalisation de l'apparence
                style: {
                    // Styles personnalisés pour le formulaire de carte
                },
                onReady: function() {
                    console.log('SumUp prêt');
                    sumupInstance = true;
                },
                onCardSubmitted: function(response) {
                    // Cette fonction est appelée lorsque l'utilisateur soumet les informations de carte
                    // mais AVANT que le paiement ne soit traité
                    console.log('Carte soumise:', response);
                    
                    // Éviter les traitements multiples
                    if (isProcessingPayment) {
                        return;
                    }
                    isProcessingPayment = true;
                    
                    // Afficher l'indicateur de chargement
                    toggleLoading(true);
                    
                    // Créer la commande et traiter le paiement
                    processSumUpPayment(response);
                }
            });
        }
        
        // Traiter le paiement SumUp
        function processSumUpPayment(cardResponse) {
            const email = document.getElementById('email').value;
            const tickets = collectTicketData();
            
            if (!email || tickets.length === 0) {
                showError('Veuillez remplir tous les champs');
                toggleLoading(false);
                isProcessingPayment = false;
                return;
            }
            
            // Envoyer la requête au serveur pour créer la commande
            fetch('/payment/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    email: email,
                    payment_method: 'sumup',
                    tickets: tickets
                })
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        throw new Error('Erreur serveur: ' + text);
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Utiliser la réponse de SumUp pour finaliser le paiement
                    // Le SDK SumUp a déjà créé le paiement, nous devons juste le valider
                    // avec l'ID de transaction retourné par SumUp
                    if (cardResponse && cardResponse.transaction_id) {
                        // Rediriger vers la page de succès
                        window.location.href = '/payment/success/' + data.reference;
                    } else {
                        // Si nous n'avons pas l'ID de transaction, nous devons créer un paiement
                        SumUpCard.pay({
                            // ID de la transaction du serveur
                            id: data.checkout_id,
                            // Montant en centimes
                            amount: data.amount * 100,
                            // Devise
                            currency: 'EUR',
                            // Callback de succès
                            onSuccess: function(response) {
                                // Rediriger vers la page de succès
                                window.location.href = '/payment/success/' + data.reference;
                            },
                            // Callback d'erreur
                            onError: function(error) {
                                console.error('Erreur SumUp:', error);
                                showError('Une erreur est survenue lors du paiement: ' + error.message);
                                toggleLoading(false);
                                isProcessingPayment = false;
                            }
                        });
                    }
                } else {
                    showError('Erreur: ' + data.message);
                    toggleLoading(false);
                    isProcessingPayment = false;
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showError('Une erreur est survenue. Veuillez réessayer.');
                toggleLoading(false);
                isProcessingPayment = false;
            });
        }
        
        // Gestion de la soumission du formulaire pour le paiement en espèces
        document.getElementById('payment-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
            
            if (paymentMethod === 'sumup') {
                return; // SumUp gère déjà la soumission
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
            
            // Envoyer la requête au serveur pour le paiement en espèces
            fetch('/payment/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    email: email,
                    payment_method: 'cash',
                    tickets: tickets
                })
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        throw new Error('Erreur serveur: ' + text);
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Rediriger vers la page de succès
                    window.location.href = '/payment/success/' + data.reference;
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
        
        // Déclencher le changement pour afficher SumUp par défaut
        document.querySelector('input[name="payment_method"]:checked').dispatchEvent(new Event('change'));
    });
</script>
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

.remove-ticket {
    position: absolute;
    top: 10px;
    right: 10px;
    opacity: 0.7;
    transition: opacity 0.3s ease;
}

.remove-ticket:hover {
    opacity: 1;
}

.total-price {
    font-size: 1.2rem;
    font-weight: bold;
    color: #FF9A8A;
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

#sumup-form-container {
    min-height: 200px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
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