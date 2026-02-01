@extends('layouts.app')

@section('title', 'Infos - Jade Birthday 23 - Bellini Fest')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="page-header text-center mb-5" data-aos="fade-up">
                <h1 class="display-4 fw-bold mb-3 text-white">Infos Pratiques</h1>
                <p class="lead text-white-50">Tout ce que vous devez savoir pour le Jade's Birthday 23</p>
                
    
            </div>
            
            <!-- Lieu -->
            <div class="info-section mb-5" data-aos="fade-up" data-aos-delay="100">
                <h2 class="section-title mb-4"><i class="fas fa-map-location-dot me-2"></i> Lieu</h2>
                <div class="card location-card border-0 shadow-lg overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="location-image-container">
                                <img src="{{ asset('images/location.jpg') }}" class="img-fluid location-image" alt="Ilet Thierry">
                                <div class="location-overlay"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body p-4 bg-dark text-white">
                                <h3 class="card-title">Ilet Thierry</h3>
                                <p class="card-text">Un lieu paradisiaque pour une fête inoubliable !</p>
                                <div class="location-details mt-3">
                                    <div class="detail-item">
                                        <i class="fas fa-ship me-2"></i>
                                        <span>Accès par bateau depuis le port du François</span>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3768.123456789!2d55.123456789!3d-21.123456789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjfCsDA3JzI0LjUiTiA1NcKwMDcnMjQuNSJF!5e0!3m2!1sen!2sre!4v1234567890" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
            
            <!-- Horaires -->
            <div class="info-section mb-5" data-aos="fade-up" data-aos-delay="200">
                <h2 class="section-title mb-4"><i class="fas fa-clock me-2"></i> Horaires</h2>
                <div class="card schedule-card bg-dark text-white border-0 shadow-lg">
                    <div class="card-body p-4">
                        <div class="timeline-container">
                            <div class="timeline-item">
                                <div class="timeline-dot start-dot"></div>
                                <div class="timeline-content">
                                    <h4>14 Mars 2026</h4>
                                    <div class="time-badge bg-danger text-white px-3 py-2 rounded d-inline-block">
                                        <i class="fas fa-door-open me-2"></i> 15:00
                                    </div>
                                    <p class="mt-2">Arrivée des premiers invités</p>
                                </div>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="timeline-dot middle-dot"></div>
                                <div class="timeline-content">
                                    <div class="time-badge bg-warning text-dark px-3 py-2 rounded d-inline-block">
                                        <i class="fas fa-glass-cheers me-2"></i> 15:30
                                    </div>
                                    <p class="mt-2">Début des festivités</p>
                                </div>
                            </div>
                            
                            <div class="timeline-item">
                                <div class="timeline-dot end-dot"></div>
                                <div class="timeline-content">
                                    <div class="time-badge bg-danger text-white px-3 py-2 rounded d-inline-block">
                                        <i class="fas fa-door-closed me-2"></i> 21:00
                                    </div>
                                    <p class="mt-2">Fin de la fête</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Dress Code -->
            <div class="info-section mb-5" data-aos="fade-up" data-aos-delay="300">
                <h2 class="section-title mb-4"><i class="fas fa-shirt me-2"></i> Dress Code: Pink and Red Style</h2>
                <div class="card dress-code-card bg-dark text-white border-0 shadow-lg">
                    <div class="card-body p-4">
                        <p class="card-text">Pour cette édition spéciale, nous vous invitons à revêtir vos plus belles tenues dans les tons rose et rouge. Soyez créatifs et amusez-vous avec votre style !</p>
                        
                        <div class="dress-code-tabs mt-4">
                            <ul class="nav nav-pills mb-4 justify-content-center" id="dressCodeTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="women-tab" data-bs-toggle="pill" data-bs-target="#women" type="button" role="tab">Femmes</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="men-tab" data-bs-toggle="pill" data-bs-target="#men" type="button" role="tab">Hommes</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="dressCodeTabsContent">
                                <div class="tab-pane fade show active" id="women" role="tabpanel">
                                    <div class="row outfit-examples">
                                        <div class="col-md-4 mb-3">
                                            <div class="outfit-card">
                                                <div class="outfit-image-container">
                                                    <img src="{{ asset('images/outfit-femme-1.jpg') }}" alt="Tenue femme 1" class="img-fluid rounded">
                                                    <div class="outfit-overlay">
                                                        <span class="outfit-label">Robe rouge</span>
                                                    </div>
                                                </div>
                                                <p class="mt-2 text-center">Robe rouge avec accessoires roses</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="outfit-card">
                                                <div class="outfit-image-container">
                                                    <img src="{{ asset('images/outfit-femme-2.jpg') }}" alt="Tenue femme 2" class="img-fluid rounded">
                                                    <div class="outfit-overlay">
                                                        <span class="outfit-label">Combinaison rose</span>
                                                    </div>
                                                </div>
                                                <p class="mt-2 text-center">Combinaison rose avec détails rouges</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="outfit-card">
                                                <div class="outfit-image-container">
                                                    <img src="{{ asset('images/outfit-femme-3.jpg') }}" alt="Tenue femme 3" class="img-fluid rounded">
                                                    <div class="outfit-overlay">
                                                        <span class="outfit-label">Style festival</span>
                                                    </div>
                                                </div>
                                                <p class="mt-2 text-center">Style festival avec touches rose et rouge</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="men" role="tabpanel">
                                    <div class="row outfit-examples">
                                        <div class="col-md-4 mb-3">
                                            <div class="outfit-card">
                                                <div class="outfit-image-container">
                                                    <img src="{{ asset('images/outfit-homme-1.jpg') }}" alt="Tenue homme 1" class="img-fluid rounded">
                                                    <div class="outfit-overlay">
                                                        <span class="outfit-label">Chemise rouge</span>
                                                    </div>
                                                </div>
                                                <p class="mt-2 text-center">Chemise rouge avec pantalon noir</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="outfit-card">
                                                <div class="outfit-image-container">
                                                    <img src="{{ asset('images/outfit-homme-2.jpg') }}" alt="Tenue homme 2" class="img-fluid rounded">
                                                    <div class="outfit-overlay">
                                                        <span class="outfit-label">T-shirt rose</span>
                                                    </div>
                                                </div>
                                                <p class="mt-2 text-center">T-shirt rose avec veste rouge</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="outfit-card">
                                                <div class="outfit-image-container">
                                                    <img src="{{ asset('images/outfit-homme-3.jpg') }}" alt="Tenue homme 3" class="img-fluid rounded">
                                                    <div class="outfit-overlay">
                                                        <span class="outfit-label">Style décontracté</span>
                                                    </div>
                                                </div>
                                                <p class="mt-2 text-center">Style décontracté avec accents rose/rouge</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact -->
            <div class="info-section mb-5" data-aos="fade-up" data-aos-delay="500">
                <h2 class="section-title mb-4"><i class="fas fa-envelope me-2"></i> Contact</h2>
                <div class="card contact-card bg-dark text-white border-0 shadow-lg">
                    <div class="card-body p-4">
                        <p class="card-text">Pour toute question, n'hésitez pas à contacter Jade :</p>
                        <div class="contact-methods">
                            <a href="tel:+596696388072" class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="contact-text">
                                    <h5>Téléphone</h5>
                                    <p>+596 696 38 80 72</p>
                                </div>
                            </a>
                            <a href="mailto:jade.buval@gmail.com" class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-text">
                                    <h5>Email</h5>
                                    <p>jade.buval@gmail.com</p>
                                </div>
                            </a>
                            <a href="https://instagram.com/jaad.bvl" target="_blank" class="contact-item">
                                <div class="contact-icon">
                                    <i class="fab fa-instagram"></i>
                                </div>
                                <div class="contact-text">
                                    <h5>Instagram</h5>
                                    <p>@jaad.bvl</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Styles généraux */
.info-section {
    margin-bottom: 3rem;
}

.section-title {
    color: #FF9A8A;
    font-family: 'Unbounded', cursive;
    font-weight: 700;
    font-size: 1.8rem;
    text-shadow: 0 0 10px rgba(255, 154, 138, 0.3);
}

/* Header décorations */
.header-decoration {
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

/* Carte de lieu */
.location-card {
    border-radius: 20px;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.location-card:hover {
    transform: translateY(-5px);
}

.location-image-container {
    position: relative;
    height: 100%;
    min-height: 300px;
    overflow: hidden;
}

.location-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.location-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(255, 106, 136, 0.7), rgba(255, 154, 138, 0.7));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.location-card:hover .location-overlay {
    opacity: 1;
}

.location-card:hover .location-image {
    transform: scale(1.05);
}

.location-details {
    margin-top: 20px;
}

.detail-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    color: rgba(255, 255, 255, 0.8);
}

.detail-item i {
    color: #FF9A8A;
    margin-right: 10px;
    width: 20px;
}

.map-container {
    border-radius: 0 0 20px 20px;
    overflow: hidden;
}

/* Timeline pour les horaires */
.timeline-container {
    position: relative;
    padding-left: 30px;
}

.timeline-container::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    height: 100%;
    width: 2px;
    background: linear-gradient(to bottom, #FF6A88, #FF9A8A);
}

.timeline-item {
    position: relative;
    margin-bottom: 40px;
}

.timeline-dot {
    position: absolute;
    left: -30px;
    top: 5px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.start-dot {
    background: #FF6A88;
}

.middle-dot {
    background: #FFC107;
}

.end-dot {
    background: #FF6A88;
}

/* Dress Code */
.dress-code-card {
    border-radius: 20px;
}

.nav-pills .nav-link {
    border-radius: 50px;
    padding: 8px 20px;
    margin: 0 5px;
    background: rgba(255, 255, 255, 0.1);
    color: rgba(255, 255, 255, 0.7);
    transition: all 0.3s ease;
}

.nav-pills .nav-link.active {
    background: linear-gradient(135deg, #FF6A88, #FF9A8A);
    color: white;
}

.outfit-card {
    transition: transform 0.3s ease;
    cursor: pointer;
}

.outfit-card:hover {
    transform: translateY(-10px);
}

.outfit-image-container {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
}

.outfit-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to top, rgba(255, 106, 136, 0.8), transparent);
    display: flex;
    align-items: flex-end;
    padding: 15px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.outfit-card:hover .outfit-overlay {
    opacity: 1;
}

.outfit-label {
    color: white;
    font-weight: bold;
    font-size: 1.1rem;
}

/* Contact */
.contact-card {
    border-radius: 20px;
}

.contact-methods {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-top: 20px;
}

.contact-item {
    display: flex;
    align-items: center;
    width: 100%;
    margin-bottom: 15px;
    padding: 15px;
    border-radius: 15px;
    background: rgba(255, 255, 255, 0.05);
    transition: all 0.3s ease;
    text-decoration: none;
    color: white;
}

.contact-item:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateX(5px);
    color: white;
}

.contact-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #FF6A88, #FF9A8A);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    color: white;
    font-size: 1.2rem;
}

.contact-text h5 {
    margin-bottom: 5px;
    font-weight: 600;
}

.contact-text p {
    margin-bottom: 0;
    color: rgba(255, 255, 255, 0.7);
}

/* Responsive */
@media (max-width: 768px) {
    .contact-methods {
        flex-direction: column;
    }
    
    .contact-item {
        width: 100%;
    }
}
</style>
@endpush