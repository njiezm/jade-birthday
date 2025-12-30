@extends('layouts.app')

@section('title', 'Validation du Billet')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="validation-card text-center p-5">
                @if($status === 'success')
                    <div class="validation-icon success-icon mb-4">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h1 class="mb-3">Billet Valide !</h1>
                    <p class="lead mb-4">{{ $message }}</p>
                @else
                    <div class="validation-icon error-icon mb-4">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <h1 class="mb-3">Billet Invalide</h1>
                    <p class="lead mb-4">{{ $message }}</p>
                @endif

                <div class="ticket-details mt-4 p-3 bg-light bg-opacity-10 rounded">
                    <p class="mb-1"><strong>Nom:</strong> {{ $ticket->firstname }} {{ $ticket->lastname }}</p>
                    <p class="mb-0"><strong>Commande:</strong> {{ $order->reference }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.validation-card {
    background: var(--glass);
    backdrop-filter: blur(20px);
    border: 1px solid var(--glass-border);
    border-radius: 40px;
    box-shadow: var(--shadow);
    color: white;
}

.validation-icon {
    font-size: 5rem;
}

.success-icon {
    color: #4CAF50; /* Vert */
}

.error-icon {
    color: #f44336; /* Rouge */
}
</style>
@endpush