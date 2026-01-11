@extends('layouts.app')

@section('title', 'Validation du Billet')

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
        <div class="col-lg-6">
            <div class="validation-card text-center p-5">
                @if($status === 'success')
                    <div class="validation-icon success-icon mb-4">
                        <div class="validation-circle success-circle">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                    <h1 class="mb-3">Billet Valide !</h1>
                    <p class="lead mb-4">{{ $message }}</p>
                @else
                    <div class="validation-icon error-icon mb-4">
                        <div class="validation-circle error-circle">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <h1 class="mb-3">Billet Invalide</h1>
                    <p class="lead mb-4">{{ $message }}</p>
                @endif

                <div class="ticket-details mt-4 p-3 bg-light bg-opacity-10 rounded">
                    <p class="mb-1"><strong>Nom:</strong> {{ $ticket->firstname }} {{ $ticket->lastname }}</p>
                    <p class="mb-0"><strong>Commande:</strong> {{ $order->reference }}</p>
                </div>
                
                <!-- Éléments décoratifs -->
                <div class="validation-decoration">
                    <div class="decoration-item decoration-1">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div class="decoration-item decoration-2">
                        <i class="fas fa-cocktail"></i>
                    </div>
                    <div class="decoration-item decoration-3">
                        <i class="fas fa-music"></i>
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
.validation-card {
    background: var(--glass);
    backdrop-filter: blur(20px);
    border: 1px solid var(--glass-border);
    border-radius: 40px;
    box-shadow: var(--shadow);
    color: white;
    position: relative;
    overflow: hidden;
}

/* Icône de validation */
.validation-icon {
    position: relative;
    display: inline-block;
}

.validation-circle {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2.5rem;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.success-circle {
    background: linear-gradient(135deg, #4CAF50, #8BC34A);
    box-shadow: 0 10px 20px rgba(76, 175, 80, 0.3);
    animation: pulse 2s infinite;
}

.error-circle {
    background: linear-gradient(135deg, #f44336, #FF9800);
    box-shadow: 0 10px 20px rgba(244, 67, 54, 0.3);
    animation: shake 2s infinite;
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

@keyframes shake {
    0%, 100% {
        transform: translateX(0);
    }
    10%, 30%, 50%, 70%, 90% {
        transform: translateX(-5px);
    }
    20%, 40%, 60%, 80% {
        transform: translateX(5px);
    }
}

/* Décorations */
.validation-decoration {
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

/* Détails du billet */
.ticket-details {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    border: 1px solid rgba(255, 255, 255, 0.2);
}
</style>
@endpush