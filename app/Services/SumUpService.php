<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class SumUpService
{
    protected $client;
    protected $apiKey;
    protected $apiSecret;
    protected $merchantCode;
    protected $accessToken;
    
    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.sumup.api_key');
        $this->apiSecret = config('services.sumup.api_secret');
        $this->merchantCode = config('services.sumup.merchant_code');
        
        // Obtenir le token d'accès
        $this->authenticate();
    }
    
    /**
     * Authentifie le service auprès de l'API SumUp
     */
    protected function authenticate()
    {
        try {
            $response = $this->client->post('https://api.sumup.com/token', [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->apiKey,
                    'client_secret' => $this->apiSecret,
                ]
            ]);
            
            $data = json_decode($response->getBody()->getContents());
            $this->accessToken = $data->access_token;
            
        } catch (\Exception $e) {
            Log::error('SumUp authentication error: ' . $e->getMessage());
            throw new \Exception('Erreur d\'authentification SumUp: ' . $e->getMessage());
        }
    }
    
    /**
     * Crée une session de paiement SumUp
     */
    public function createCheckout($amount, $email, $successUrl, $cancelUrl)
    {
        try {
            $response = $this->client->post('https://api.sumup.com/v0.1/checkouts', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'amount' => $amount * 100, // SumUp attend le montant en centimes
                    'currency' => 'EUR',
                    'checkout_reference' => uniqid('checkout_'),
                    'merchant_code' => $this->merchantCode,
                    'pay_to_email' => config('services.sumup.pay_to_email'),
                    'description' => 'Billets pour THE 23 BELLINI FEST',
                    'customer_email' => $email,
                    'redirect_url' => $successUrl,
                    'cancel_url' => $cancelUrl,
                ]
            ]);
            
            return json_decode($response->getBody()->getContents());
            
        } catch (\Exception $e) {
            Log::error('SumUp checkout creation error: ' . $e->getMessage());
            throw new \Exception('Erreur lors de la création du checkout SumUp: ' . $e->getMessage());
        }
    }
    
    /**
     * Récupère les informations d'une session de paiement
     */
    public function getCheckout($checkoutId)
    {
        try {
            $response = $this->client->get("https://api.sumup.com/v0.1/checkouts/{$checkoutId}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ]
            ]);
            
            return json_decode($response->getBody()->getContents());
            
        } catch (\Exception $e) {
            Log::error('SumUp checkout retrieval error: ' . $e->getMessage());
            throw new \Exception('Erreur lors de la récupération du checkout SumUp: ' . $e->getMessage());
        }
    }
}