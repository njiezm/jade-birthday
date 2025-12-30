@extends('layouts.app')

@section('title', 'Wishlist - Jade Birthday 23 - Bellini Fest')

@section('floating-assets')
    <x-floating-asset class="asset-bellini-1" svg="bellini.png"/>
    <x-floating-asset class="asset-coupe-1" svg="coupe.png"/>
    <x-floating-asset class="asset-smirnoff-1" svg="smirnoff.png"/>
    <x-floating-asset class="asset-martini-1" svg="martini.png"/>
@endsection

@section('content')
<div class="wishlist-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1 class="hero-title">WISHLIST</h1>
                    <p class="hero-subtitle">Pour mes 23 ans, offrez-moi un cadeau inoubliable</p>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <span class="stat-number">23</span>
                            <span class="stat-label">Ans</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">14</span>
                            <span class="stat-label">Mars</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">2026</span>
                            <span class="stat-label">Année</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image">
                    <img src="{{ asset('images/bellini-hero.png') }}" alt="Martini Bellini" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="wishlist-container">
                <div class="text-center mb-5">
                    <h2 class="section-title">Choisissez votre cadeau</h2>
                    <p class="section-subtitle">Chaque contribution, grande ou petite, sera appréciée et contribuera à rendre cette journée spéciale</p>
                </div>
                
                <div class="gifts-grid">
                    <div class="gift-card gift-contribution" data-type="contribution" data-amount="20">
                        <div class="gift-icon">
                            <i class="fas fa-gift"></i>
                        </div>
                        <h4>Contribution Libre</h4>
                        <p>Offrez-moi une contribution pour mon futur voyage ou autre projet.</p>
                        <div class="amount-options">
                            <button class="amount-btn" data-amount="10">10€</button>
                            <button class="amount-btn" data-amount="20">20€</button>
                            <button class="amount-btn" data-amount="50">50€</button>
                            <button class="amount-btn custom-amount">Autre</button>
                        </div>
                    </div>
                    
                    <div class="gift-card gift-bottle" data-type="bottle" data-amount="36">
                        <div class="gift-icon">
                            <i class="fas fa-wine-bottle"></i>
                        </div>
                        <h4>Martini Bellini</h4>
                        <p>Le cocktail emblématique de la fête pour célébrer en beauté.</p>
                        <div class="amount-display">
                            <span class="amount">36€</span>
                        </div>
                    </div>
                    
                    <div class="gift-card gift-music" data-type="music" data-amount="0">
                        <div class="gift-icon">
                            <i class="fas fa-music"></i>
                        </div>
                        <h4>Playlist Music</h4>
                        <p>Contribuez à la playlist parfaite pour la fête du siècle.</p>
                        <div class="amount-display">
                            <span class="amount">Gratuit</span>
                        </div>
                    </div>
                    
                    <div class="gift-card gift-photoshoot" data-type="photoshoot" data-amount="100">
                        <div class="gift-icon">
                            <i class="fas fa-camera-retro"></i>
                        </div>
                        <h4>Shooting Photo</h4>
                        <p>Offrez-moi un souvenir impérissable de mes 23 ans.</p>
                        <div class="amount-display">
                            <span class="amount">100€</span>
                        </div>
                    </div>
                    
                    <div class="gift-card gift-project" data-type="project" data-amount="500">
                        <div class="gift-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h4>Mes Projets</h4>
                        <p>Soutenez mes projets créatifs et entrepreneuriaux.</p>
                        <div class="amount-display">
                            <span class="amount">500€</span>
                        </div>
                    </div>
                </div>
                
                <div class="donation-progress mt-5">
                    <h3 class="text-center mb-4">Progression du don</h3>
                    <div class="progress-container">
                        <div class="progress-bar" style="width: 35%;">
                            <div class="progress-fill"></div>
                        </div>
                        <div class="progress-stats text-center mt-2">
                            <span class="current-amount">350€</span> / <span class="target-amount">1000€</span>
                        </div>
                    </div>
                </div>
                
                <div class="recent-donations mt-5">
                    <h3 class="text-center mb-4">Dons récents</h3>
                    <div class="donations-list">
    @forelse($recentDonations as $donation)
        <div class="donation-item">
            <div class="donation-avatar">
                @if($donation->author_name)
                    <span class="avatar-text">
                        {{ strtoupper(substr($donation->author_name, 0, 1)) }}
                    </span>
                @else
                    <span class="avatar-text">A</span>
                @endif
            </div>

            <div class="donation-details">
                <div class="donation-type">{{ $donation->type }}</div>
                <div class="donation-amount">{{ $donation->amount }}€</div>
                <div class="donation-date">{{ $donation->created_at->format('d/m') }}</div>
            </div>
        </div>
    @empty
        <div class="text-center py-3">
            <p class="text-muted">Aucun don pour le moment</p>
        </div>
    @endforelse
</div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour le don personnalisé -->
<div class="modal fade" id="customAmountModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-0">
                <h5 class="modal-title">Montant personnalisé</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="custom-amount-form">
                    <div class="mb-3">
                        <label for="custom-amount" class="form-label">Montant (€)</label>
                        <input type="number" class="form-control bg-dark text-white border-secondary" id="custom-amount" min="1" step="1">
                    </div>
                    <div class="preset-amounts mt-3">
                        <button type="button" class="btn btn-outline-light btn-sm preset-amount" data-amount="25">25€</button>
                        <button type="button" class="btn btn-outline-light btn-sm preset-amount" data-amount="75">75€</button>
                        <button type="button" class="btn btn-outline-light btn-sm preset-amount" data-amount="150">150€</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirm-custom-amount">Valider</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-0">
                <h5 class="modal-title">Confirmer votre don</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="confirmation-details">
                    <h6>Type de don:</h6>
                    <p id="confirmation-type"></p>
                    <h6>Montant:</h6>
                    <p id="confirmation-amount"></p>
                    <h6>Votre nom:</h6>
                    <p id="confirmation-name"></p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirm-donation">Confirmer</button>
            </div>
        </div>
    </div>
</div>

<!-- Contribution Form -->
<div class="contribution-form-container" id="contribution-form" style="display: none;">
    <div class="contribution-form">
        <h3 id="form-title">Faire une contribution</h3>
        <form action="{{ route('wishlist.store') }}" method="POST" id="wishlist-form">
            @csrf
            <input type="hidden" id="contribution-type" name="type" value="contribution">
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Votre nom</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Votre email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            
            <div class="mb-3" id="amount-container">
                <label for="amount" class="form-label">Montant (€)</label>
                <input type="number" class="form-control" id="amount" name="amount" min="1" required>
            </div>
            
            <div class="mb-3">
                <label for="message" class="form-label">Message (optionnel)</label>
                <textarea class="form-control" id="message" name="message" rows="3"></textarea>
            </div>
            
            <!-- Options de paiement -->
            <div class="payment-methods mb-4">
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
                            <span>Carte bancaire</span>
                        </div>
                    </label>
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-outline-light" id="cancel-btn">Annuler</button>
                <button type="submit" class="btn btn-danger" id="submit-btn">
                    <i class="bi bi-lock me-2"></i>Payer maintenant
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Conteneur pour les boutons de paiement -->
<div class="text-center mt-4">
    <div id="paypal-button-container" class="mb-3" style="display: none;"></div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
</div>
@endif
@endsection

<script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.' . config('paypal.mode') . '.client_id') }}&currency=EUR&intent=capture"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const giftCards = document.querySelectorAll('.gift-card');
        const contributionForm = document.getElementById('contribution-form');
        const cancelBtn = document.getElementById('cancel-btn');
        const formTitle = document.getElementById('form-title');
        const contributionType = document.getElementById('contribution-type');
        const amountContainer = document.getElementById('amount-container');
        const amountInput = document.getElementById('amount');
        const wishlistForm = document.getElementById('wishlist-form');
        const submitBtn = document.getElementById('submit-btn');
        const paypalContainer = document.getElementById('paypal-button-container');
        let paypalButtonsRendered = false;
        
        // Récupérer le token CSRF
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                          document.querySelector('input[name="_token"]')?.value;
        
        // Afficher les erreurs
        function showError(message) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'alert alert-danger alert-dismissible fade show';
            errorDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            
            const container = document.querySelector('.wishlist-container');
            container.insertBefore(errorDiv, container.firstChild);
            
            // Masquer après 5 secondes
            setTimeout(() => {
                if (errorDiv.parentNode) {
                    errorDiv.parentNode.removeChild(errorDiv);
                }
            }, 5000);
        }
        
        // Configuration pour chaque type de cadeau
        const giftConfig = {
            contribution: {
                title: 'Faire une contribution',
                showAmount: true,
                defaultAmount: 20,
                amounts: [10, 20, 50, 'custom']
            },
            bottle: {
                title: 'Offrir un Martini Bellini',
                showAmount: false,
                defaultAmount: 36
            },
            music: {
                title: 'Participer à la playlist',
                showAmount: false,
                defaultAmount: 0
            },
            photoshoot: {
                title: 'Offrir un shooting photo',
                showAmount: false,
                defaultAmount: 100
            },
            project: {
                title: 'Soutenir mes projets',
                showAmount: false,
                defaultAmount: 500
            }
        };
        
        // Gestion des cartes de cadeau
        giftCards.forEach(card => {
            card.addEventListener('click', function() {
                const type = this.getAttribute('data-type');
                const config = giftConfig[type];
                
                formTitle.textContent = config.title;
                contributionType.value = type;
                
                // Gestion des montants prédéfinis
                const amountOptions = this.querySelector('.amount-options');
                if (amountOptions) {
                    amountOptions.style.display = 'flex';
                }
                
                if (config.showAmount) {
                    amountContainer.style.display = 'block';
                    amountInput.value = config.defaultAmount;
                    amountInput.required = true;
                } else {
                    amountContainer.style.display = 'none';
                    amountInput.required = false;
                }
                
                contributionForm.style.display = 'block';
                contributionForm.scrollIntoView({ behavior: 'smooth' });
            });
        });
        
        // Gestion des boutons de montant prédéfini
        document.querySelectorAll('.amount-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const amount = this.getAttribute('data-amount');
                amountInput.value = amount;
            });
        });
        
        // Gestion du bouton de montant personnalisé
        document.querySelectorAll('.custom-amount').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('custom-amount').value = '';
                const customAmountModal = new bootstrap.Modal(document.getElementById('customAmountModal'));
                customAmountModal.show();
            });
        });
        
        // Gestion du bouton de validation du montant personnalisé
        document.getElementById('confirm-custom-amount').addEventListener('click', function() {
            const customAmount = document.getElementById('custom-amount').value;
            if (customAmount && customAmount > 0) {
                amountInput.value = customAmount;
                document.getElementById('customAmountModal').hide();
            }
        });
        
        // Bouton pour annuler
        cancelBtn.addEventListener('click', function() {
            contributionForm.style.display = 'none';
        });
        
        // Gestion du changement de méthode de paiement
        document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'paypal') {
                    paypalContainer.style.display = 'block';
                    submitBtn.style.display = 'none';
                    
                    // Render PayPal buttons only once
                    if (!paypalButtonsRendered) {
                        renderPayPalButtons();
                        paypalButtonsRendered = true;
                    }
                } else {
                    paypalContainer.style.display = 'none';
                    submitBtn.style.display = 'inline-block';
                }
            });
        });
        
        // Configuration du bouton PayPal
        function renderPayPalButtons() {
            paypal.Buttons({
                createOrder: function(data, actions) {
                    const name = document.getElementById('name').value;
                    const email = document.getElementById('email').value;
                    const amount = document.getElementById('amount').value;
                    const message = document.getElementById('message').value;
                    const type = document.getElementById('contribution-type').value;
                    
                    if (!name || !email || (amountContainer.style.display !== 'none' && !amount)) {
                        showError('Veuillez remplir tous les champs requis');
                        return;
                    }
                    
                    // Envoyer la requête au serveur
                    return fetch('{{ route("wishlist.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            name: name,
                            email: email,
                            amount: amount,
                            message: message,
                            type: type,
                            payment_method: 'paypal'
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
                        window.location.href = '/wishlist/success/' + details.purchase_units[0].reference_id;
                    });
                },
                onError: function(err) {
                    console.error('Erreur PayPal:', err);
                    showError('Une erreur est survenue lors du paiement PayPal.');
                }
            }).render('#paypal-button-container');
        }
        
        // Gestion de la soumission du formulaire pour Stripe
        wishlistForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
            
            if (paymentMethod === 'paypal') {
                return; // PayPal gère déjà la soumission
            }
            
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const amount = document.getElementById('amount').value;
            const message = document.getElementById('message').value;
            const type = document.getElementById('contribution-type').value;
            
            if (!name || !email || (amountContainer.style.display !== 'none' && !amount)) {
                showError('Veuillez remplir tous les champs requis');
                return;
            }
            
            // Afficher le modal de confirmation
            showConfirmationModal(type, amount, name);
        });
        
        // Fonction pour afficher le modal de confirmation
        function showConfirmationModal(type, amount, name) {
            const typeText = {
                contribution: 'Contribution',
                bottle: 'Martini Bellini',
                music: 'Playlist Music',
                photoshoot: 'Shooting Photo',
                project: 'Mes Projets'
            };
            
            document.getElementById('confirmation-type').textContent = typeText[type] || type;
            document.getElementById('confirmation-amount').textContent = amount + '€';
            document.getElementById('confirmation-name').textContent = name;
            
            const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            confirmationModal.show();
        }
        
        // Gestion du bouton de confirmation
        document.getElementById('confirm-donation').addEventListener('click', function() {
            const type = document.getElementById('confirmation-type').textContent;
            const amount = document.getElementById('confirmation-amount').textContent;
            const name = document.getElementById('confirmation-name').textContent;
            
            // Fermer le modal de confirmation
            bootstrap.Modal.getInstance(document.getElementById('confirmationModal')).hide();
            
            // Soumettre le formulaire
            submitDonation();
        });
        
        // Fonction pour soumettre le don
        function submitDonation() {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const amount = document.getElementById('amount').value;
            const message = document.getElementById('message').value;
            const type = document.getElementById('contribution-type').value;
            
            // Afficher un indicateur de chargement
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Chargement...';
            submitBtn.disabled = true;
            
            // Envoyer la requête au serveur pour Stripe
            fetch('{{ route("wishlist.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    name: name,
                    email: email,
                    amount: amount,
                    message: message,
                    type: type,
                    payment_method: 'stripe'
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
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        }
    });
</script>
@endsection

@push('styles')
<style>
/* Hero Section Styles */
.wishlist-hero {
    background: linear-gradient(135deg, var(--rose) 0%, var(--dark-red) 100%);
    padding: 100px 0;
    position: relative;
    overflow: hidden;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-title {
    font-size: clamp(3rem, 8vw, 5rem);
    font-weight: 900;
    line-height: 0.9;
    margin-bottom: 20px;
    color: white;
    text-shadow: 0 0 20px rgba(0,0,0,0.5);
    background: linear-gradient(45deg, var(--peach), var(--rose), var(--red));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.hero-subtitle {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 30px;
}

.hero-stats {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-top: 20px;
}

.stat-item {
    text-align: center;
    color: white;
}

.stat-number {
    display: block;
    font-size: 2.5rem;
    font-weight: 700;
    font-family: 'Unbounded', cursive;
    line-height: 1;
}

.stat-label {
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.hero-image {
    position: relative;
    z-index: 1;
}

.hero-image img {
    width: 100%;
    height: auto;
    filter: drop-shadow(0 10px 30px rgba(0,0,0,0.3);
    border-radius: 10px;
    transform: rotate(5deg);
}

/* Wishlist Container */
.wishlist-container {
    background: var(--glass);
    backdrop-filter: blur(20px);
    border: 1px solid var(--glass-border);
    border-radius: 40px;
    padding: 40px;
    box-shadow: var(--shadow);
    margin-top: -50px;
    position: relative;
    z-index: 10;
}

.section-title {
    font-family: 'Unbounded', cursive;
    font-size: 2.5rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 15px;
    color: white;
}

.section-subtitle {
    text-align: center;
    color: rgba(255, 255, 255, 0.9);
    max-width: 600px;
    margin: 0 auto;
}

/* Gift Cards */
.gifts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
    margin-bottom: 30px;
}

.gift-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 30px;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    cursor: pointer;
}

.gift-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--peach), var(--rose), var(--red));
    opacity: 0.1;
    z-index: 1;
    transition: opacity 0.3s ease;
}

.gift-card:hover::before {
    opacity: 0.3;
}

.gift-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

.gift-icon {
    font-size: 3rem;
    margin-bottom: 20px;
    color: var(--peach);
    z-index: 2;
    position: relative;
}

.gift-bottle .gift-icon {
    color: var(--rose);
}

.gift-music .gift-icon {
    color: var(--light-peach);
}

.gift-photoshoot .gift-icon {
    color: var(--light-rose);
}

.gift-project .gift-icon {
    color: var(--light-peach);
}

.gift-card h4 {
    font-family: 'Unbounded', cursive;
    font-size: 1.5rem;
    margin-bottom: 15px;
    color: white;
    z-index: 2;
    position: relative;
}

.gift-card p {
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 0;
    z-index: 2;
    position: relative;
}

.amount-options {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 15px;
}

.amount-btn {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 5px 15px;
    color: white;
    font-size: 0.9rem;
    transition: all 0.2s ease;
}

.amount-btn:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.4);
}

.custom-amount {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 5px 15px;
    color: white;
    font-size: 0.9rem;
    transition: all 0.2s ease;
}

.custom-amount:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.4);
}

.amount-display {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    padding: 8px 15px;
    margin-top: 15px;
    text-align: center;
}

.amount {
    font-size: 1.5rem;
    font-weight: 700;
    font-family: 'Unbounded', cursive;
}

/* Progress Bar */
.donation-progress {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 20px;
    margin-top: 30px;
}

.progress-container {
    position: relative;
    height: 20px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    background: linear-gradient(90deg, var(--peach), var(--rose), var(--red));
    width: 35%;
    border-radius: 10px;
    transition: width 0.5s ease;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--peach), var(--rose), var(--red));
    width: 35%;
    border-radius: 10px;
}

.progress-stats {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
    font-weight: 600;
}

/* Recent Donations */
.recent-donations {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 20px;
}

.donations-list {
    max-height: 300px;
    overflow-y: auto;
}

.donation-item {
    display: flex;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.donation-item:last-child {
    border-bottom: none;
}

.donation-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--rose);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    margin-right: 15px;
}

.avatar-text {
    font-family: 'Unbounded', cursive;
    font-size: 0.9rem;
}

.donation-details {
    flex: 1;
}

.donation-type {
    font-family: 'Unbounded', cursive;
    text-transform: uppercase;
    font-size: 0.8rem;
    color: var(--peach);
    margin-bottom: 5px;
}

.donation-amount {
    font-weight: 700;
    color: white;
    font-size: 1.1rem;
}

.donation-date {
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.7);
}

/* Form Styles */
.contribution-form {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 30px;
    margin-top: 20px;
}

.form-control {
    background: rgba(255, 255, : 255, 0.1);
    border: 1px solid var(--glass-border);
    color: white;
}

.form-control:focus {
    background: rgba(255, 255, 255, 0.2);
    border-color: var(--responsive-border);
    box-shadow: 0 0 0 0.25rem rgba(255, 106, 136, 0.25);
    color: white;
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

/* Payment Methods */
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

#paypal-button-container {
    min-height: 45px;
}

.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* Modal Styles */
.modal-content {
    border-radius: 20px;
    border: none;
}

.modal-header {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.modal-title {
    color: white;
}

.btn-close-white {
    filter: invert(1);
}

/* Responsive */
@media (max-width: 991px) {
    .gifts-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
    
    .hero-content {
        text-align: center;
    }
    
    .hero-image {
        margin-top: 30px;
        transform: rotate(0deg);
    }
}

@media (max-width: 768px) {
    .wishlist-container {
        margin-top: -30px;
        padding: 30px;
    }
    
    .hero-stats {
        flex-direction: column;
        gap: 15px;
    }
    
    .stat-number {
        font-size: 2rem;
    }
}
</style>
@endpush