<?php

namespace App\Services;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

class PayPalService
{
    private $client;
    
    public function __construct()
    {
        $config = config('paypal');
        
        if ($config['mode'] === 'sandbox') {
            $environment = new SandboxEnvironment($config['sandbox']['client_id'], $config['sandbox']['client_secret']);
        } else {
            $environment = new ProductionEnvironment($config['live']['client_id'], $config['live']['client_secret']);
        }
        
        $this->client = new PayPalHttpClient($environment);
    }
    
    public function createOrder($amount, $returnUrl, $cancelUrl)
    {
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            'intent' => 'CAPTURE',
            'purchase_units' => [[
                'reference_id' => 'JBF-' . uniqid(),
                'description' => 'Billets pour THE 23 BELLINI FEST',
                'amount' => [
                    'currency_code' => config('paypal.currency', 'EUR'),
                    'value' => (string)$amount
                ]
            ]],
            'application_context' => [
                'cancel_url' => $cancelUrl,
                'return_url' => $returnUrl,
                'brand_name' => 'Jade Birthday 23 - Bellini Fest',
                'locale' => 'fr-FR',
                'landing_page' => 'BILLING',
                'shipping_preference' => 'NO_SHIPPING',
                'user_action' => 'PAY_NOW',
            ]
        ];
        
        try {
            return $this->client->execute($request);
        } catch (\Exception $e) {
            throw new \Exception('Erreur lors de la création de la commande PayPal: ' . $e->getMessage());
        }
    }
    
    public function captureOrder($orderId)
    {
        $request = new OrdersCaptureRequest($orderId);
        
        try {
            return $this->client->execute($request);
        } catch (\Exception $e) {
            throw new \Exception('Erreur lors de la capture du paiement PayPal: ' . $e->getMessage());
        }
    }
}