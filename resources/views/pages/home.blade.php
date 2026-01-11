@extends('layouts.app')

@section('title', 'Jade Birthday 23 - Bellini Fest')

@section('floating-assets')
    <x-floating-asset class="asset-bellini-1" svg="bellini.png"/>
    <x-floating-asset class="asset-smirnoff-1" svg="smirnoffB.png"/>
    <x-floating-asset class="asset-glass-1" svg="coupe-martini.png"/>
    <x-floating-asset class="asset-bellini-2" svg="martini-peach.png"/>
    <x-floating-asset class="asset-smirnoff-2" svg="smirnoff-silver.png"/>
    <x-floating-asset class="asset-glass-2" svg="coupe-bellini.png"/>
    
    <!-- Nouveaux éléments flottants -->
    <x-floating-asset class="asset-confetti-1" svg="confetti.png"/>
    <x-floating-asset class="asset-balloon-1" svg="ballon-rose.png"/>
    <x-floating-asset class="asset-balloon-2" svg="ballon-peche.png"/>
    <x-floating-asset class="asset-music-1" svg="note-musique.png"/>
    <x-floating-asset class="asset-star-1" svg="etoile.png"/>
    <x-floating-asset class="asset-champagne-1" svg="champagne.png"/>
    <x-floating-asset class="asset-disco-1" svg="disco-ball.png"/>
    <x-floating-asset class="asset-cocktail-1" svg="cocktail-colorful.png"/>
@endsection

@section('header')
<header class="festival-header">
    <div class="header-img-container">
        <div class="header-overlay"></div>
        <!-- Logo ajouté dans l'en-tête -->
        <div class="logo-container">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid logo-header">
        </div>
    </div>
    
    <div class="header-content container text-center margin-bottom-50">
        <br>
        <br>
        <br>
        <br> 
        
        <!-- Bouteilles au-dessus de "Jade Présente" -->
        <div class="bottles-top-container d-flex justify-content-center mb-3" data-aos="fade-down" data-aos-delay="100">
            <div class="bottle-container mx-3">
                <img src="{{ asset('images/bellini.png') }}" alt="Bellini" class="img-fluid bottle-image">
            </div>
            
        </div>
        
        <div class="header-badge mt-5" data-aos="fade-down" data-aos-delay="200">
            <p class="mb-0 text-uppercase fw-bold tracking-widest ">Jade Présente</p>
        </div>
        
        <!-- Bouteilles en dessous de "Jade Présente" -->
        <div class="bottles-bottom-container d-flex justify-content-center mt-3" data-aos="fade-up" data-aos-delay="300">
           
           <div class="title-side-image title-right-image bottle-big">
    <img src="{{ asset('images/smirnoff.png') }}" alt="Smirnoff">
</div>

        </div>
        
        <!-- Conteneur pour le titre avec les images de chaque côté -->
        <div class="title-container" data-aos="zoom-in" data-aos-delay="400">
            <!-- Image Bellini à gauche -->
            <div class="title-side-image title-left-image">
                <img src="{{ asset('images/logo.png') }}" alt="Bellini" class="img-fluid">
            </div>
            
            <!-- Titre au centre -->
            <h1 class="festival-title">
                THE 23<br>BELLINI FEST
            </h1>
            
            <!-- Image Smirnoff à droite -->
            <div class="title-side-image title-right-image">
                <img src="{{ asset('images/smirnoff.png') }}" alt="Smirnoff" style="max-width: 180px;" class="img-fluid">
            </div>
        </div>
        
        <div class="event-details" data-aos="fade-up" data-aos-delay="600">
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <span class="badge bg-white text-danger rounded-0 px-4 py-2">
                    <i class="far fa-calendar me-2"></i>14 MARS 2026
                </span>
                <span class="badge bg-transparent border border-white rounded-0 px-4 py-2">
                    <i class="fas fa-location-dot me-2"></i>PLAN BATEAU DE FOLIE
                </span>
            </div>
        </div>
        
        <div class="mt-4" data-aos="fade-up" data-aos-delay="800">
            <a href="#content" class="btn btn-outline-light btn-lg rounded-pill px-4">
                <i class="bi bi-arrow-down-circle me-2"></i> Découvrir
            </a>
        </div>
        
        <!-- Compte à rebours -->
        <div class="countdown-container mt-5 mb-30" style="background: transparent" data-aos="fade-up" data-aos-delay="1000">
            <div class="countdown" id="countdown">
                <div class="countdown-item">
                    <span class="countdown-number" id="days">00</span>
                    <span class="countdown-label">Jours</span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-number" id="hours">00</span>
                    <span class="countdown-label">Heures</span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-number" id="minutes">00</span>
                    <span class="countdown-label">Minutes</span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-number" id="seconds">00</span>
                    <span class="countdown-label">Secondes</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Textes manuscrits -->
    <div class="handwritten-text handwritten-1" data-aos="fade-right" data-aos-delay="1200">Let's Party!</div>
    <div class="handwritten-text handwritten-2" data-aos="fade-left" data-aos-delay="1400">Cheers!</div>
</header>
@endsection

@section('content')
<div id="content" class="container pb-5">
    <!-- Intro Section -->
    <div class="row justify-content-center margin-top-50">
        <div class="col-lg-12">
            <div class="intro-section margin-top-50" data-aos="fade-up">
                <div class="row align-items-center">
                    <div class="col-md-8 text-center text-md-start mb-5 mb-md-0">
                        <div class="d-flex align-items-start mb-4">
                            <div class="jade-bullet me-3">
                                <img src="{{ asset('images/jade.jpg') }}" alt="Jade" class="rounded-circle jade-photo" style="width: 80px; height: 80px; object-fit: cover;">
                            </div>
                            <div>
                                <h2 class="mb-4 display-5">SUN, CHILL AND DRINKS</h2>
                                <p class="lead mb-4">
                                    Parce qu'on a 23 ans qu'une seule fois...<br>
                                    Viens célébrez avec moi sous le signe du soleil, du chill et des bonnes vibes<br>
                                    Au programme :<br>
                                    la douceur d'un Martini Bellini,<br>
                                    le caractère d'une Smirnoff bien fraîche<br>
                                    de la musique,<br>
                                    des couleurs rose et rouge<br>
                                    et surtout...une énorme dose de bonne humeur<br>
                                    Zéro chichi, juste profiter, danser, trinquer et kiffer le moment
                                </p>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-center justify-content-md-start gap-3">
                            <div class="time-info text-center">
                                <h4 class="mb-0 fw-bold">15h</h4>
                                <small class="text-uppercase opacity-75">Start</small>
                            </div>
                            <div class="vr"></div>
                            <div class="time-info text-center">
                                <h4 class="mb-0 fw-bold">21h</h4>
                                <small class="text-uppercase opacity-75">End</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="birthday-photo-container position-relative d-none d-md-block" data-aos="zoom-in">
                            <img src="{{ asset('images/jade.jpg') }}" alt="Photo de Jade" class="img-fluid rounded-4 shadow-lg">
                            <div class="photo-frame"></div>
                            
                            <!-- Éléments décoratifs flottants autour de la photo -->
                            <div class="floating-decoration decoration-1">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="floating-decoration decoration-2">
                                <i class="fas fa-music"></i>
                            </div>
                            <div class="floating-decoration decoration-3">
                                <i class="fas fa-cocktail"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Section avec images flottantes -->
    <div class="row mt-5 mb-4 position-relative">
        <div class="col-12">
            <h3 class="text-center mb-4" data-aos="fade-up">Ambiance</h3>
        </div>
        
        <!-- Texte descriptif au centre -->
        <div class="col-lg-8 mx-auto text-center mt-5" data-aos="fade-up" data-aos-delay="600">
            <p class="lead">
                Plonge dans une ambiance festive, chill et solaire.
            </p>
        </div>
    </div>

    <!-- Dashboard Grid avec design amélioré -->
    <div class="row g-4 mt-5">
        <div class="col-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <a href="{{ route('billetterie') }}" class="card-link">
                <div class="card-tile card-tile-danger">
                    <div class="card-icon">
                        <i class="fas fa-ticket-simple"></i>
                    </div>
                    <h4>Billetterie</h4>
                    <p>Prends ta place. Nominatif avec QR Code.</p>
                    <div class="card-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('wishlist') }}" class="card-link">
                <div class="card-tile card-tile-peach">
                    <div class="card-icon">
                        <i class="fas fa-wand-magic-sparkles"></i>
                    </div>
                    <h4>Wishlist</h4>
                    <p>Envie de me gâter ? C'est par ici.</p>
                    <div class="card-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <a href="{{ route('galerie') }}" class="card-link">
                <div class="card-tile card-tile-rose">
                    <div class="card-icon">
                        <i class="fas fa-clapperboard"></i>
                    </div>
                    <h4>Live Snaps</h4>
                    <p>Partagez vos photos & vidéos en live.</p>
                    <div class="card-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
            <a href="{{ route('infos') }}" class="card-link">
                <div class="card-tile card-tile-red">
                    <div class="card-icon">
                        <i class="fas fa-map-pin"></i>
                    </div>
                    <h4>Infos</h4>
                    <p>Plan bateau de folie et horaires.</p>
                    <div class="card-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <!-- Interactive Wall Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="interactive-wall p-4 rounded-4" data-aos="fade-up">
                <h3 class="text-center mb-4">Mur de la Fête <i class="bi bi-stars"></i></h3>
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="wall-form mb-4">
                            <form id="message-form" class="d-flex flex-column gap-3">
                                <input type="text" class="form-control" id="author-name" placeholder="Ton nom" required>
                                <textarea class="form-control" id="message-content" rows="3" placeholder="Laisse moi un petit mot 💓" required></textarea>
                                <button type="submit" class="btn btn-light btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Envoyer mon message
                                </button>
                            </form>
                        </div>
                        <div id="message-wall" class="message-wall">
                            <!-- Les messages seront chargés ici via JavaScript -->
                            <div class="text-center">
                                <div class="spinner-border text-light" role="status">
                                    <span class="visually-hidden">Chargement...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Éléments décoratifs flottants -->
                <div class="wall-decoration decoration-1">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="wall-decoration decoration-2">
                    <i class="fas fa-star"></i>
                </div>
                <div class="wall-decoration decoration-3">
                    <i class="fas fa-music"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer avec logo -->
<footer class="footer mt-5 py-4">
    <div class="container text-center">
        <div class="footer-logo mb-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid footer-logo-img">
        </div>
        <p class="text-white-50 mb-0">© 2026 Jade Birthday 23 - Bellini Fest. Tous droits réservés.</p>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser les particules
        particlesJS('particles-js', {
            particles: {
                number: {
                    value: 80,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: '#ffffff'
                },
                shape: {
                    type: 'circle'
                },
                opacity: {
                    value: 0.5,
                    random: false
                },
                size: {
                    value: 3,
                    random: true
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#ffffff',
                    opacity: 0.4,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 2,
                    direction: 'none',
                    random: false,
                    straight: false,
                    out_mode: 'out',
                    bounce: false
                }
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: {
                        enable: true,
                        mode: 'grab'
                    },
                    onclick: {
                        enable: true,
                        mode: 'push'
                    },
                    resize: true
                },
                modes: {
                    grab: {
                        distance: 140,
                        line_linked: {
                            opacity: 1
                        }
                    },
                    push: {
                        particles_nb: 4
                    }
                }
            },
            retina_detect: true
        });
        
        // Compte à rebours - Correction de la date pour 15h au lieu de 21h
        function updateCountdown() {
            const eventDate = new Date('March 14, 2026 15:00:00').getTime(); // Changé de 21:00 à 15:00
            const now = new Date().getTime();
            const distance = eventDate - now;
            
            if (distance < 0) {
                document.getElementById('countdown').innerHTML = '<div class="countdown-item"><span class="countdown-number">L\'événement est en cours!</span></div>';
                return;
            }
            
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            document.getElementById('days').innerText = days.toString().padStart(2, '0');
            document.getElementById('hours').innerText = hours.toString().padStart(2, '0');
            document.getElementById('minutes').innerText = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').innerText = seconds.toString().padStart(2, '0');
        }
        
        updateCountdown();
        setInterval(updateCountdown, 1000);
        
        // Charger les messages au chargement de la page
        loadMessages();
        
        // Gérer la soumission du formulaire
        document.getElementById('message-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const authorName = document.getElementById('author-name').value;
            const content = document.getElementById('message-content').value;
            
            // Envoyer le message via AJAX
            fetch('/api/messages', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    author_name: authorName,
                    content: content
                })
            })
            .then(response => response.json())
            .then(data => {
                // Ajouter le nouveau message au mur
                addMessageToWall(data);
                
                // Réinitialiser le formulaire
                document.getElementById('author-name').value = '';
                document.getElementById('message-content').value = '';
                
                // Afficher une notification de succès
                showNotification('Message envoyé avec succès !', 'success');
            })
            .catch(error => {
                console.error('Erreur:', error);
                showNotification('Une erreur est survenue. Veuillez réessayer.', 'error');
            });
        });
        
        // Fonction pour charger les messages
        function loadMessages() {
            fetch('/api/messages')
                .then(response => response.json())
                .then(messages => {
                    const messageWall = document.getElementById('message-wall');
                    messageWall.innerHTML = '';
                    
                    if (messages.length === 0) {
                        messageWall.innerHTML = '<p class="text-center">Soyez le premier à laisser un message !</p>';
                        return;
                    }
                    
                    messages.forEach(message => {
                        addMessageToWall(message);
                    });
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    document.getElementById('message-wall').innerHTML = '<p class="text-center">Impossible de charger les messages.</p>';
                });
        }
        
        // Fonction pour ajouter un message au mur
        function addMessageToWall(message) {
            const messageWall = document.getElementById('message-wall');
            
            // Si c'est le premier message ou si le mur est vide
            if (messageWall.querySelector('.text-center') !== null) {
                messageWall.innerHTML = '';
            }
            
            const messageItem = document.createElement('div');
            messageItem.className = 'message-item';
            messageItem.innerHTML = `
                <strong>${message.author_name}</strong>
                <p>${message.content}</p>
                <small class="text-muted d-block">${formatDate(message.created_at)}</small>
            `;
            
            // Ajouter au début du mur
            messageWall.insertBefore(messageItem, messageWall.firstChild);
            
            // Limiter le nombre de messages affichés à 10
            const messageItems = messageWall.querySelectorAll('.message-item');
            if (messageItems.length > 10) {
                messageItems[messageItems.length - 1].remove();
            }
        }
        
        // Fonction pour formater la date
        function formatDate(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const diffMs = now - date;
            const diffMins = Math.floor(diffMs / 60000);
            
            if (diffMins < 1) {
                return "À l'instant";
            } else if (diffMins < 60) {
                return `Il y a ${diffMins} minute${diffMins > 1 ? 's' : ''}`;
            } else if (diffMins < 1440) {
                const diffHours = Math.floor(diffMins / 60);
                return `Il y a ${diffHours} heure${diffHours > 1 ? 's' : ''}`;
            } else {
                return date.toLocaleDateString('fr-FR');
            }
        }
        
        // Fonction pour afficher une notification
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'} position-fixed top-0 start-50 translate-middle-x mt-3`;
            notification.style.zIndex = '9999';
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            // Supprimer la notification après 3 secondes
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
        
        // Animation des particules
        const particles = document.querySelectorAll('.particle');
        
        particles.forEach((particle, index) => {
            // Taille aléatoire
            const size = Math.random() * 10 + 5;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            
            // Position de départ aléatoire
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `${Math.random() * 100}%`;
            
            // Animation de flottement
            const duration = Math.random() * 20 + 10;
            const delay = Math.random() * 5;
            
            particle.style.animation = `float ${duration}s ease-in-out ${delay}s infinite`;
        });
    });

    // Correction du scroll pour le bouton Découvrir
    document.querySelector('a[href="#content"]').addEventListener('click', function(e) {
        e.preventDefault();
        
        const target = document.querySelector('#content');
        const headerHeight = window.innerWidth <= 767 ? 150 : 100; // Plus d'espace sur mobile
        
        window.scrollTo({
            top: target.offsetTop - headerHeight,
            behavior: 'smooth'
        });
    });
</script>

<style>
/* Styles pour optimiser l'affichage mobile */
.jade-photo {
    object-position: center;
    object-fit: cover;
    border: 3px solid #fff;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
}

.logo-container {
    position: absolute;
    top: 20px;
    left: 20px;
    z-index: 10;
}

.logo-header {
    max-width: 120px;
    height: auto;
}

/* Styles pour les bouteilles */
.bottle-container {
    max-width: 120px;
}

.bottle-image {
    max-height: 150px;
    object-fit: contain;
}

.card-tile {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 20px;
    height: 100%;
    transition: transform 0.3s ease;
}

.card-tile:hover {
    transform: translateY(-5px);
}

.card-icon {
    margin-bottom: 15px;
}

.card-tile h4 {
    margin-bottom: 10px;
}

.card-tile p {
    margin-bottom: 15px;
    flex-grow: 1;
}

.card-arrow {
    margin-top: auto;
}

.message-item {
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 15px;
}

/* Styles pour le footer */
.footer {
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
}

.footer-logo-img {
    max-width: 100px;
    height: auto;
}

/* Responsive styles */
@media (max-width: 767px) {
    .logo-container {
        top: 10px;
        left: 10px;
    }
    
    .logo-header {
        max-width: 80px;
    }
    
    .bottle-container {
        max-width: 280px;
    }
    
    .bottle-image {
        max-height: 180px;
    }
    
    .title-container {
        flex-direction: column;
    }
    
    .title-side-image {
        display: none;
    }
    
    .festival-title {
        font-size: 2.5rem;
    }
    
    .card-tile {
        padding: 15px;
        min-height: 180px;
    }
}

@media (max-width: 576px) {
    .festival-title {
        font-size: 2rem;
    }
    
    .countdown-item {
        min-width: 60px;
    }
    
    .card-tile {
        min-height: 150px;
    }
    
   
}
/* Bouteilles générales */
.bottle-container {
    width: 280px;   /* TAILLE RÉELLE */
}

.bottle-image {
    width: 100%;
    height: auto;
}

/* Desktop */
@media (min-width: 992px) {
    .bottle-container {
        width: 520px;
    }
}

/* Tablette */
@media (max-width: 991px) {
    .bottle-container {
        width: 240px;
    }
}

/* Mobile */
@media (max-width: 576px) {
    .bottle-container {
        width: 400px;
    }
}

/* Bouteilles géantes autour du titre */
.bottle-big img {
    height: 420px;      /* 🔥 GROS */
    width: auto;
    max-width: none;
    object-fit: contain;
}

/* Desktop large */
@media (min-width: 1200px) {
    .bottle-big img {
        height: 500px;
    }
}

/* Tablette */
@media (max-width: 991px) {
    .bottle-big img {
        height: 340px;
    }
}

/* Mobile */
@media (max-width: 576px) {
    .bottle-big img {
        height: 260px;
    }
}

.bottle-big {
    transform: translateY(-40px);
}

.title-right-image {
    transform: rotate(6deg);
}

.title-left-image {
    transform: rotate(-6deg);
}


</style>
@endsection