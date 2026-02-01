<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;
use Stripe\Webhook;

class StripeService
{
    public function __construct()
    {
        // Configuration de la clé API Stripe
        Stripe::setApiKey(config('services.stripe.secret'));
    }
    
    public function createCheckoutSession($amount, $currency, $email, $successUrl, $cancelUrl)
    {
        return Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => $currency,
                    'product_data' => [
                        'name' => 'Billet THE 23 BELLINI FEST',
                        'description' => '14 Mars 2026 - Plan Bateau de Folie',
                    ],
                    'unit_amount' => $amount,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'customer_email' => $email,
            'success_url' => $successUrl,
            'cancel_url' => $cancelUrl,
        ]);
    }
    
    public function getCheckoutSession($sessionId)
    {
        return Session::retrieve($sessionId);
    }
    
    public function createPaymentIntent($amount, $currency, $metadata = [])
    {
        return PaymentIntent::create([
            'amount' => $amount,
            'currency' => $currency,
            'metadata' => $metadata,
            'payment_method_types' => ['card'],
        ]);
    }
    
    public function constructWebhookEvent($payload, $sigHeader)
    {
        $webhookSecret = config('services.stripe.webhook_secret');
        return Webhook::constructEvent($payload, $sigHeader, $webhookSecret);
    }
}