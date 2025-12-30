<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;
use Exception;

class StripeService
{
    public function __construct()
    {
        // Récupérer la clé secrète depuis la configuration
        $secretKey = config('services.stripe.secret');
        
        // Journaliser la clé pour le débogage (masquez la plupart des caractères pour la sécurité)
        if ($secretKey) {
            $maskedKey = substr($secretKey, 0, 8) . '...' . substr($secretKey, -4);
            Log::info('Stripe secret key found', ['key' => $maskedKey]);
        } else {
            Log::error('Stripe secret key is missing from config');
            throw new Exception('La clé secrète Stripe n\'est pas configurée. Veuillez vérifier votre fichier .env et config/services.php');
        }
        
        Stripe::setApiKey($secretKey);
    }
    
    public function createCheckoutSession($amount, $email, $successUrl, $cancelUrl, $metadata = [])
    {
        try {
            Log::info('Creating Stripe session', ['amount' => $amount, 'email' => $email]);
            
            $session = Session::create([
                'payment_method_types' => ['card'],
                'customer_email' => $email,
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'eur',
                            'product_data' => [
                                'name' => 'Billet pour THE 23 BELLINI FEST',
                                'description' => 'Billet d\'entrée pour le festival',
                            ],
                            'unit_amount' => $amount * 100, // Stripe utilise les centimes
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => $successUrl,
                'cancel_url' => $cancelUrl,
                'metadata' => $metadata,
            ]);
            
            Log::info('Stripe session created successfully', ['session_id' => $session->id]);
            
            return $session;
            
        } catch (Exception $e) {
            Log::error('Error creating Stripe session', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw new Exception('Erreur lors de la création de la session Stripe: ' . $e->getMessage());
        }
    }
    
    public function retrieveSession($sessionId)
    {
        try {
            Log::info('Retrieving Stripe session', ['session_id' => $sessionId]);
            
            $session = Session::retrieve($sessionId);
            
            Log::info('Stripe session retrieved', ['status' => $session->payment_status]);
            
            return $session;
            
        } catch (Exception $e) {
            Log::error('Error retrieving Stripe session', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw new Exception('Erreur lors de la récupération de la session Stripe: ' . $e->getMessage());
        }
    }
}