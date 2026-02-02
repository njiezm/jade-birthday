@extends('layouts.app')

@section('title', 'Wishlist - Jade Birthday 23 - Bellini Fest')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="wishlist-container">
                <div class="text-center mb-5">
                    <h2 class="section-title">Choisissez votre cadeau</h2>
                    <p class="section-subtitle">Chaque contribution, grande ou petite, sera appréciée et contribuera à rendre cette journée spéciale</p>
                </div>
                
                <div class="gifts-grid">
                    <!-- Bijoux chevillère -->
                    <div class="gift-card" data-type="chevillere" data-amount="50" data-description="Bijoux chevillère">
                        <div class="gift-image">
                            <img src="{{ asset('images/wishlist/chevillere.jpg') }}" alt="Bijoux chevillère" class="img-fluid">
                        </div>
                        <h4>Bijoux chevillère</h4>
                        <p>Un bijou élégant pour sublimer ma cheville.</p>
                        <div class="amount-display">
                            <span class="amount">50€</span>
                        </div>
                    </div>
                    
                    <!-- Bague de pied -->
                    <div class="gift-card" data-type="bague-pied" data-amount="30" data-description="Bague de pied">
                        <div class="gift-image">
                            <img src="{{ asset('images/wishlist/bague-pied.jpg') }}" alt="Bague de pied" class="img-fluid">
                        </div>
                        <h4>Bague de Pied</h4>
                        <p>Une touche d'élégance pour mes pieds.</p>
                        <div class="amount-display">
                            <span class="amount">30€</span>
                        </div>
                    </div>
                    
                    <!-- Boucle d'oreille -->
                    <div class="gift-card" data-type="boucle-oreille" data-amount="40" data-description="Boucle d'oreille">
                        <div class="gift-image">
                            <img src="{{ asset('images/wishlist/boucle-oreille.jpg') }}" alt="Boucle d'oreille" class="img-fluid">
                        </div>
                        <h4>Boucle d'Oreille</h4>
                        <p>Des boucles d'oreilles pour illuminer mon visage.</p>
                        <div class="amount-display">
                            <span class="amount">40€</span>
                        </div>
                    </div>
                    
                    <!-- Rouge à lèvre matte -->
                    <div class="gift-card" data-type="rouge-levre" data-amount="25" data-description="Rouge à lèvre matte">
                        <div class="gift-image">
                            <img src="{{ asset('images/wishlist/rouge-levre.jpg') }}" alt="Rouge à lèvre matte" class="img-fluid">
                        </div>
                        <h4>Rouge à Lèvre Matte</h4>
                        <p>Un maquillage intense pour mes lèvres.</p>
                        <div class="amount-display">
                            <span class="amount">25€</span>
                        </div>
                    </div>
                    
                    <!-- Voyage -->
                    <div class="gift-card" data-type="voyage" data-amount="900" data-description="Voyage">
                        <div class="gift-image">
                            <img src="{{ asset('images/wishlist/voyage.jpg') }}" alt="Voyage" class="img-fluid">
                        </div>
                        <h4>Voyage</h4>
                        <p>Une escapade pour célébrer mes 23 ans.</p>
                        <div class="amount-display">
                            <span class="amount">900€</span>
                        </div>
                    </div>
                    
                    <!-- Journée détente -->
                    <div class="gift-card" data-type="detente" data-amount="100" data-description="Journée détente">
                        <div class="gift-image">
                            <img src="{{ asset('images/wishlist/spa.jpg') }}" alt="Journée détente" class="img-fluid">
                        </div>
                        <h4>Journée Détente</h4>
                        <p>Massage spa et hôtel pour une journée de pure relaxation.</p>
                        <div class="amount-display">
                            <span class="amount">100€</span>
                        </div>
                    </div>
                    
                    <!-- Pochette d'ordinateur -->
                    <div class="gift-card" data-type="pochette" data-amount="35" data-description="Pochette d'ordinateur">
                        <div class="gift-image">
                            <img src="{{ asset('images/wishlist/pochette.jpg') }}" alt="Pochette d'ordinateur" class="img-fluid">
                        </div>
                        <h4>Pochette d'Ordinateur</h4>
                        <p>Une pochette élégante pour protéger mon ordinateur.</p>
                        <div class="amount-display">
                            <span class="amount">35€</span>
                        </div>
                    </div>
                    
                    <!-- Parfum -->
                    <div class="gift-card" data-type="parfum" data-amount="65" data-description="Parfum La Vie Est Belle Élixir">
                        <div class="gift-image">
                            <img src="{{ asset('images/wishlist/parfum.jpg') }}" alt="Parfum La vie est belle élixir" class="img-fluid">
                        </div>
                        <h4>Parfum La Vie Est Belle Élixir</h4>
                        <p>Mon parfum préféré pour une fragrance enivrante.</p>
                        <div class="amount-display">
                            <span class="amount">65€</span>
                        </div>
                    </div>
                    
                    <!-- Chaussures -->
                    <div class="gift-card" data-type="chaussures" data-amount="80" data-description="Paire de chaussures">
                        <div class="gift-image">
                            <img src="{{ asset('images/wishlist/chaussures.jpg') }}" alt="Paire de chaussures" class="img-fluid">
                        </div>
                        <h4>Paire de Chaussures</h4>
                        <p>Alhona rose fluo ou verre d'eau (pointure 39/40) ou carte cadeau.</p>
                        <div class="amount-display">
                            <span class="amount">80€</span>
                        </div>
                    </div>
                    
                    <!-- Trépied -->
                    <div class="gift-card" data-type="trepied" data-amount="45" data-description="Trépied">
                        <div class="gift-image">
                            <img src="{{ asset('images/wishlist/trepied.jpg') }}" alt="Trépied" class="img-fluid">
                        </div>
                        <h4>Trépied</h4>
                        <p>Un trépied stable pour mes photos et vidéos.</p>
                        <div class="amount-display">
                            <span class="amount">45€</span>
                        </div>
                    </div>
                    
                    <!-- Pédicure -->
                    <div class="gift-card" data-type="pedicure" data-amount="60" data-description="Pause Pédicure">
                        <div class="gift-image">
                            <img src="{{ asset('images/wishlist/pedicure.jpg') }}" alt="Pédicure" class="img-fluid">
                        </div>
                        <h4>Pause Pédicure</h4>
                        <p>Une séance de pédicure chez Mamk Beauty.</p>
                        <div class="amount-display">
                            <span class="amount">60€</span>
                        </div>
                    </div>
                    
                    <!-- Red Line -->
                    <div class="gift-card" data-type="redline" data-amount="500" data-description="Bijou Red Line">
                        <div class="gift-image">
                            <img src="{{ asset('images/wishlist/redline.jpg') }}" alt="Red Line" class="img-fluid">
                        </div>
                        <h4>Bijou Red Line</h4>
                        <p>Un bijou élégant de la marque Red Line.</p>
                        <div class="amount-display">
                            <span class="amount">500€</span>
                        </div>
                    </div>
                    
                    <!-- New Balance -->
                    <div class="gift-card" data-type="newbalance" data-amount="90" data-description="New Balance Rose">
                        <div class="gift-image">
                            <img src="{{ asset('images/wishlist/newbalance.jpg') }}" alt="New Balance rose" class="img-fluid">
                        </div>
                        <h4>New Balance Rose</h4>
                        <p>Des baskets New Balance en rose.</p>
                        <div class="amount-display">
                            <span class="amount">90€</span>
                        </div>
                    </div>
                    
                    <!-- Cartes Cadeaux -->
                    <div class="gift-card" data-type="cartescadeaux" data-amount="50" data-description="Cartes Cadeaux">
                        <div class="gift-image">
                            <img src="{{ asset('images/wishlist/cartes-cadeaux.jpg') }}" alt="Cartes cadeaux" class="img-fluid">
                        </div>
                        <h4>Cartes Cadeaux</h4>
                        <p>Des cartes cadeaux pour mes magasins préférés.</p>
                        <div class="amount-display">
                            <span class="amount">50€</span>
                        </div>
                    </div>
                    
                    <!-- Maille Cyclone Or -->
                    <div class="gift-card" data-type="maille" data-amount="70" data-description="Maille Cyclone Or">
                        <div class="gift-image">
                            <img src="{{ asset('images/wishlist/maille.jpg') }}" alt="Maille Cyclone Or" class="img-fluid">
                        </div>
                        <h4>Maille Cyclone Or</h4>
                        <p>Petit diamètre - Taille S.</p>
                        <div class="amount-display">
                            <span class="amount">70€</span>
                        </div>
                    </div>
                    
                    <!-- Piercing au nez -->
                    <div class="gift-card" data-type="piercing" data-amount="30" data-description="Piercing au nez">
                        <div class="gift-image">
                            <img src="{{ asset('images/wishlist/piercing.jpg') }}" alt="Piercing au nez" class="img-fluid">
                        </div>
                        <h4>Piercing au Nez</h4>
                        <p>Un piercing élégant pour mon nez.</p>
                        <div class="amount-display">
                            <span class="amount">30€</span>
                        </div>
                    </div>
                    
                    <!-- Contribution libre (dernier élément) -->
                    <div class="gift-card gift-contribution" data-type="contribution" data-amount="20">
                        <div class="gift-image">
                            <img src="{{ asset('images/wishlist/contribution.jpg') }}" alt="Contribution libre" class="img-fluid">
                        </div>
                        <h4>Ce Que Votre Cœur Vous Permet</h4>
                        <p>Offrez-moi une contribution pour mes projets ou rêves.</p>
                        <div class="amount-options">
                            <button class="amount-btn" data-amount="10">10€</button>
                            <button class="amount-btn" data-amount="20">20€</button>
                            <button class="amount-btn" data-amount="50">50€</button>
                            <button class="amount-btn custom-amount">Autre</button>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <button class="btn btn-danger btn-lg" id="direct-donation-btn">
                        <i class="fas fa-hand-holding-usd me-2"></i>Faire un don direct
                    </button>
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
                <h5 class="modal-title">Confirmer votre choix</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="confirmation-details">
                    <h6>Type de cadeau:</h6>
                    <p id="confirmation-type"></p>
                    <h6 id="amount-label">Montant:</h6>
                    <p id="confirmation-amount"></p>
                    <h6>Votre nom:</h6>
                    <p id="confirmation-name"></p>
                    <h6 id="delivery-label">Mode de livraison:</h6>
                    <p id="confirmation-delivery"></p>
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
            
            <div class="mb-3">
                <label for="name" class="form-label">Votre nom</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Votre email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            
            <div class="mb-3" id="amount-container">
                <label for="amount" class="form-label">Montant (€)</label>
                <input type="number" class="form-control" id="amount" name="amount" min="1" required>
            </div>
            
            <div class="mb-3">
                <label for="message" class="form-label">Message (optionnel)</label>
                <textarea class="form-control" id="message" name="message" rows="3"></textarea>
            </div>
            
            <!-- Options de livraison/paiement -->
<div class="payment-methods mb-4">
    <h4>Mode de livraison/paiement</h4>
    <div class="payment-options">
        <label class="payment-option">
            <input type="radio" name="payment_method" value="transfer" checked>
            <div class="payment-option-content">
                <i class="fas fa-university"></i>
                <span>Virement bancaire</span>
            </div>
        </label>
        <label class="payment-option">
            <input type="radio" name="payment_method" value="inperson">
            <div class="payment-option-content">
                <i class="fas fa-hand-holding-heart"></i>
                <span>Offrir en main propre</span>
            </div>
        </label>
    </div>
    
    <!-- Informations bancaires -->
    <div id="bank-info" class="mt-4 p-3 bg-light bg-opacity-10 rounded">
        <h5>Coordonnées bancaires</h5>
        <div class="bank-details">
            <p><strong>Titulaire du compte :</strong> Jade BUVAL</p>
            <p><strong>IBAN :</strong> FR76 4061 8804 5200 0402 6057 547</p>
            <p><strong>BIC :</strong> BOUS FRPP XXX</p>
            <p><strong>Banque :</strong> 40618</p>
            <p class="mt-3"><em>Merci de noter votre nom dans la référence du virement pour que je puisse vous remercier personnellement !</em></p>
        </div>
    </div>
</div>
            
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-outline-light" id="cancel-btn">Annuler</button>
                <button type="submit" class="btn btn-danger" id="submit-btn">
                    <i class="bi bi-lock me-2"></i>Valider
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
        const messageInput = document.getElementById('message');
        const wishlistForm = document.getElementById('wishlist-form');
        const submitBtn = document.getElementById('submit-btn');
        const paypalContainer = document.getElementById('paypal-button-container');
        const directDonationBtn = document.getElementById('direct-donation-btn');
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
            chevillere: {
                title: 'Offrir une bijoux chevillère',
                showAmount: false,
                defaultAmount: 50
            },
            'bague-pied': {
                title: 'Offrir une bague de pied',
                showAmount: false,
                defaultAmount: 30
            },
            'boucle-oreille': {
                title: 'Offrir une boucle d\'oreille',
                showAmount: false,
                defaultAmount: 40
            },
            'rouge-levre': {
                title: 'Offrir un rouge à lèvre matte',
                showAmount: false,
                defaultAmount: 25
            },
            voyage: {
                title: 'Offrir un voyage',
                showAmount: false,
                defaultAmount: 900
            },
            detente: {
                title: 'Offrir une journée détente',
                showAmount: false,
                defaultAmount: 100
            },
            pochette: {
                title: 'Offrir une pochette d\'ordinateur',
                showAmount: false,
                defaultAmount: 35
            },
            parfum: {
                title: 'Offrir un parfum La Vie Est Belle Élixir',
                showAmount: false,
                defaultAmount: 65
            },
            chaussures: {
                title: 'Offrir une paire de chaussures',
                showAmount: false,
                defaultAmount: 80
            },
            trepied: {
                title: 'Offrir un trépied',
                showAmount: false,
                defaultAmount: 45
            },
            pedicure: {
                title: 'Offrir une pause pédicure',
                showAmount: false,
                defaultAmount: 60
            },
            redline: {
                title: 'Offrir un bijou Red Line',
                showAmount: false,
                defaultAmount: 500
            },
            newbalance: {
                title: 'Offrir des New Balance rose',
                showAmount: false,
                defaultAmount: 90
            },
            cartescadeaux: {
                title: 'Offrir des cartes cadeaux',
                showAmount: false,
                defaultAmount: 50
            },
            maille: {
                title: 'Offrir une Maille Cyclone Or',
                showAmount: false,
                defaultAmount: 70
            },
            piercing: {
                title: 'Offrir un piercing au nez',
                showAmount: false,
                defaultAmount: 30
            }
        };
        
        // Gestion des cartes de cadeau
        giftCards.forEach(card => {
            card.addEventListener('click', function() {
                const type = this.getAttribute('data-type');
                const config = giftConfig[type];
                const description = this.getAttribute('data-description');
                
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
                    amountInput.value = config.defaultAmount;
                }
                
                // Remplir le champ message avec "Je t'offre..." si ce n'est pas une contribution
                if (type !== 'contribution' && description) {
                    messageInput.value = `Je t'offre ${description}`;
                } else {
                    messageInput.value = '';
                }
                
                contributionForm.style.display = 'block';
                contributionForm.scrollIntoView({ behavior: 'smooth' });
            });
        });
        
        // Bouton pour faire un don direct
        directDonationBtn.addEventListener('click', function() {
            formTitle.textContent = 'Faire un don direct';
            contributionType.value = 'contribution';
            amountContainer.style.display = 'block';
            amountInput.value = 20;
            amountInput.required = true;
            messageInput.value = '';
            contributionForm.style.display = 'block';
            contributionForm.scrollIntoView({ behavior: 'smooth' });
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
        
        // Gestion du changement de méthode de paiement/livraison
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
        
        // Gestion de la soumission du formulaire
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
            showConfirmationModal(type, amount, name, paymentMethod);
        });
        
        // Fonction pour afficher le modal de confirmation
        function showConfirmationModal(type, amount, name, paymentMethod) {
            const typeText = {
                contribution: 'Contribution',
                chevillere: 'Bijoux chevillère',
                'bague-pied': 'Bague de Pied',
                'boucle-oreille': 'Boucle d\'Oreille',
                'rouge-levre': 'Rouge à Lèvre Matte',
                voyage: 'Voyage',
                detente: 'Journée Détente',
                pochette: 'Pochette d\'Ordinateur',
                parfum: 'Parfum La Vie Est Belle Élixir',
                chaussures: 'Paire de Chaussures',
                trepied: 'Trépied',
                pedicure: 'Pause Pédicure',
                redline: 'Bijou Red Line',
                newbalance: 'New Balance Rose',
                cartescadeaux: 'Cartes Cadeaux',
                maille: 'Maille Cyclone Or',
                piercing: 'Piercing au Nez'
            };
            
            document.getElementById('confirmation-type').textContent = typeText[type] || type;
            document.getElementById('confirmation-amount').textContent = amount ? amount + '€' : 'N/A';
            document.getElementById('confirmation-name').textContent = name;
            document.getElementById('confirmation-delivery').textContent = paymentMethod === 'paypal' ? 'Paiement PayPal' : 'Offrir en main propre';
            
            // Masquer ou afficher les étiquettes selon le type de cadeau
            if (type === 'contribution') {
                document.getElementById('amount-label').style.display = 'block';
                document.getElementById('confirmation-amount').style.display = 'block';
            } else {
                document.getElementById('amount-label').style.display = 'none';
                document.getElementById('confirmation-amount').style.display = 'none';
            }
            
            const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            confirmationModal.show();
        }
        
        // Gestion du bouton de confirmation
        document.getElementById('confirm-donation').addEventListener('click', function() {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const amount = document.getElementById('amount').value;
            const message = document.getElementById('message').value;
            const type = document.getElementById('contribution-type').value;
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
            
            // Fermer le modal de confirmation
            bootstrap.Modal.getInstance(document.getElementById('confirmationModal')).hide();
            
            // Soumettre le formulaire
            submitDonation(name, email, amount, message, type, paymentMethod);
        });
        
        // Fonction pour soumettre le don
        function submitDonation(name, email, amount, message, type, paymentMethod) {
            // Afficher un indicateur de chargement
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Chargement...';
            submitBtn.disabled = true;
            
            // Envoyer la requête au serveur
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
                    payment_method: paymentMethod
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
                    // Afficher un message de succès
                    const successDiv = document.createElement('div');
                    successDiv.className = 'alert alert-success alert-dismissible fade show';
                    successDiv.innerHTML = `
                        Merci ${name}! Votre choix a bien été enregistré.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    `;
                    
                    const container = document.querySelector('.wishlist-container');
                    container.insertBefore(successDiv, container.firstChild);
                    
                    // Masquer le formulaire
                    contributionForm.style.display = 'none';
                    
                    // Réinitialiser le formulaire
                    wishlistForm.reset();
                    
                    // Masquer après 5 secondes
                    setTimeout(() => {
                        if (successDiv.parentNode) {
                            successDiv.parentNode.removeChild(successDiv);
                        }
                    }, 5000);
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
    filter: drop-shadow(0 10px 30px rgba(0,0,0,0.3));
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
    gap: 35px; /* Augmenté l'espacement entre les cartes */
    margin-bottom: 40px; /* Plus d'espace en bas */
}

.gift-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 25px; /* Plus de padding interne */
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

.gift-image {
    width: 100%;
    height: 160px; /* Légèrement plus grand */
    overflow: hidden;
    border-radius: 15px;
    margin-bottom: 20px; /* Plus d'espace en bas */
    z-index: 2;
    position: relative;
    border: 3px solid rgba(255, 182, 193, 0.6);
    box-shadow: 0 0 15px rgba(255, 182, 193, 0.4);
    transition: all 0.3s ease;
}

.gift-image:hover {
    border-color: rgba(255, 182, 193, 0.9);
    box-shadow: 0 0 20px rgba(255, 182, 193, 0.6);
}

.gift-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gift-card:hover .gift-image img {
    transform: scale(1.05);
}

.gift-card h4 {
    font-family: 'Unbounded', cursive;
    font-size: 1.3rem; /* Légèrement plus grand */
    margin-bottom: 15px; /* Plus d'espace en bas */
    color: white;
    z-index: 2;
    position: relative;
}

.gift-card p {
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 20px; /* Plus d'espace en bas */
    font-size: 0.95rem; /* Légèrement plus grand */
    line-height: 1.5; /* Meilleure lisibilité */
    z-index: 2;
    position: relative;
    flex-grow: 1;
}

.amount-options {
    display: flex;
    justify-content: center;
    gap: 12px; /* Plus d'espace entre les boutons */
    margin-top: auto;
    flex-wrap: wrap; /* Permet le retour à la ligne si nécessaire */
}

.amount-btn {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 8px 18px; /* Plus grand */
    color: white;
    font-size: 0.95rem; /* Légèrement plus grand */
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
    padding: 8px 18px; /* Plus grand */
    color: white;
    font-size: 0.95rem; /* Légèrement plus grand */
    transition: all 0.2s ease;
}

.custom-amount:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.4);
}

.amount-display {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    padding: 10px 18px; /* Plus grand */
    margin-top: auto;
    text-align: center;
}

.amount {
    font-size: 1.3rem; /* Légèrement plus grand */
    font-weight: 700;
    font-family: 'Unbounded', cursive;
}

/* Form Styles */
.contribution-form {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 30px;
    margin-top: 20px;
}

.form-control {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid var(--glass-border);
    color: white;
    width: 100%;
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

/* Direct Donation Button */
#direct-donation-btn {
    margin-top: 20px;
    padding: 12px 30px;
    font-weight: 600;
    border-radius: 30px;
    transition: all 0.3s ease;
}

#direct-donation-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

/* Responsive */
@media (max-width: 991px) {
    .gifts-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px; /* Maintenir un bon espacement sur tablette */
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
        padding: 30px 20px;
    }
    
    .hero-stats {
        flex-direction: column;
        gap: 15px;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .gift-card {
        padding: 20px;
    }
    
    .gift-image {
        height: 140px;
    }
    
    .contribution-form {
        padding: 20px;
    }
    
    .payment-options {
        flex-direction: column;
        gap: 10px;
    }
    
    .payment-option-content {
        padding: 12px;
    }
    
    .gifts-grid {
        gap: 25px; /* Espacement réduit pour mobile mais toujours suffisant */
    }
}

@media (max-width: 576px) {
    .gifts-grid {
        grid-template-columns: 1fr;
        gap: 25px;
    }
    
    .gift-image {
        height: 180px;
    }
    
    .wishlist-container {
        padding: 20px 15px;
    }
    
    .contribution-form {
        padding: 15px;
    }
    
    .amount-options {
        flex-wrap: wrap;
        gap: 8px;
    }
    
    .amount-btn {
        font-size: 0.8rem;
        padding: 6px 14px; /* Ajusté pour mobile */
    }
}
</style>
@endpush