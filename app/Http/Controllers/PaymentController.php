<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ticket;
use App\Services\PayPalService;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketsPurchased;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    private $paypalService;
    private $stripeService;
    
    public function __construct(PayPalService $paypalService, StripeService $stripeService)
    {
        $this->paypalService = $paypalService;
        $this->stripeService = $stripeService;
    }
    
    public function store(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'tickets' => 'required|array|min:1',
                'tickets.*.firstname' => 'required|string|max:255',
                'tickets.*.lastname' => 'required|string|max:255',
                'payment_method' => 'required|in:paypal,stripe',
            ]);
            
            // Calculer le montant total - MODIFIÉ À 35€
            $amount = count($request->tickets) * 35; // 35€ par billet
            
            // Créer la commande avec le statut 'pending'
            $order = Order::create([
                'reference' => Order::generateReference(),
                'email' => $request->email,
                'amount' => $amount,
                'status' => 'pending',
                'payment_method' => $request->payment_method
            ]);
            
            // Créer les billets
            foreach ($request->tickets as $ticketData) {
                Ticket::create([
                    'order_id' => $order->id,
                    'firstname' => $ticketData['firstname'],
                    'lastname' => $ticketData['lastname'],
                    'qr_code_path' => '' // Sera généré après le paiement
                ]);
            }
            
            // Traiter selon la méthode de paiement
            if ($request->payment_method === 'paypal') {
                return $this->processPayPalPayment($order, $amount);
            } else {
                return $this->processStripePayment($order, $amount, $request->email);
            }
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error: ' . implode(', ', $e->errors())
            ], 422);
        } catch (\Exception $e) {
            Log::error('Payment error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue: ' . $e->getMessage()
            ], 500);
        }
    }
    
    private function processPayPalPayment($order, $amount)
    {
        try {
            $paypalOrder = $this->paypalService->createOrder(
                $amount,
                route('payment.success', ['reference' => $order->reference]),
                route('payment.cancel', ['reference' => $order->reference])
            );
            
            // Stocker l'ID de la commande PayPal
            $order->update(['paypal_order_id' => $paypalOrder->result->id]);
            
            // Retourner l'ID de la commande PayPal pour la redirection
            return response()->json([
                'success' => true,
                'orderID' => $paypalOrder->result->id
            ]);
            
        } catch (\Exception $e) {
            Log::error('PayPal error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de la commande PayPal: ' . $e->getMessage()
            ], 500);
        }
    }
    
    private function processStripePayment($order, $amount, $email)
    {
        try {
            $session = $this->stripeService->createCheckoutSession(
                $amount,
                $email,
                route('stripe.success', ['reference' => $order->reference]),
                route('stripe.cancel', ['reference' => $order->reference]),
                ['order_reference' => $order->reference]
            );
            
            // Stocker l'ID de la session Stripe
            $order->update(['stripe_session_id' => $session->id]);
            
            // Retourner l'URL de redirection de Stripe
            return response()->json([
                'success' => true,
                'redirect_url' => $session->url
            ]);
            
        } catch (\Exception $e) {
            Log::error('Stripe error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de la session Stripe: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function success(Request $request, $reference)
    {
        try {
            $order = Order::where('reference', $reference)->firstOrFail();
            
            // Vérifier si nous avons un ID de commande PayPal
            if (!$order->paypal_order_id) {
                return redirect()->route('billetterie')->with('error', 'Commande invalide.');
            }
            
            // Capturer le paiement PayPal
            $paypalOrder = $this->paypalService->captureOrder($order->paypal_order_id);
            
            if ($paypalOrder->result->status === 'COMPLETED') {
                // Mettre à jour le statut de la commande
                $order->update(['status' => 'paid']);
                
                // Générer les QR codes pour les billets
                foreach ($order->tickets as $ticket) {
                    $qrCodePath = 'qrcodes/' . $order->reference . '_' . $ticket->id . '.svg';
                    $qrCodeContent = route('ticket.validate', ['reference' => $order->reference, 'id' => $ticket->id]);
                    
                    QrCode::format('svg')
                        ->size(200)
                        ->errorCorrection('H')
                        ->generate($qrCodeContent, public_path($qrCodePath));
                    
                    $ticket->update(['qr_code_path' => $qrCodePath]);
                }
                
                // Envoyer les emails de confirmation
                Mail::to($order->email)->send(new TicketsPurchased($order));
                
                return redirect()->route('paiement.success', ['reference' => $order->reference])
                    ->with('success', 'Paiement effectué avec succès! Vos billets ont été envoyés par email.');
            } else {
                return redirect()->route('billetterie')->with('error', 'Le paiement n\'a pas pu être validé.');
            }
            
        } catch (\Exception $e) {
            Log::error('PayPal success error: ' . $e->getMessage());
            return redirect()->route('billetterie')->with('error', 'Erreur lors de la validation du paiement: ' . $e->getMessage());
        }
    }
    
    public function stripeSuccess(Request $request, $reference)
    {
        try {
            $order = Order::where('reference', $reference)->firstOrFail();
            
            if (!$order->stripe_session_id) {
                return redirect()->route('billetterie')->with('error', 'Commande invalide.');
            }
            
            $session = $this->stripeService->retrieveSession($order->stripe_session_id);
            
            if ($session->payment_status === 'paid') {
                // Mettre à jour le statut de la commande
                $order->update(['status' => 'paid']);
                
                // Générer les QR codes pour les billets
                foreach ($order->tickets as $ticket) {
                    $qrCodePath = 'qrcodes/' . $order->reference . '_' . $ticket->id . '.svg';
                    $qrCodeContent = route('ticket.validate', ['reference' => $order->reference, 'id' => $ticket->id]);
                    
                    QrCode::format('svg')
                        ->size(200)
                        ->errorCorrection('H')
                        ->generate($qrCodeContent, public_path($qrCodePath));
                    
                    $ticket->update(['qr_code_path' => $qrCodePath]);
                }
                
                // Envoyer les emails de confirmation
                Mail::to($order->email)->send(new TicketsPurchased($order));
                
                return redirect()->route('paiement.success', ['reference' => $order->reference])
                    ->with('success', 'Paiement effectué avec succès! Vos billets ont été envoyés par email.');
            } else {
                return redirect()->route('billetterie')->with('error', 'Le paiement n\'a pas pu être validé.');
            }
            
        } catch (\Exception $e) {
            Log::error('Stripe success error: ' . $e->getMessage());
            return redirect()->route('billetterie')->with('error', 'Erreur lors de la validation du paiement: ' . $e->getMessage());
        }
    }
    
    public function stripeCancel($reference)
    {
        $order = Order::where('reference', $reference)->firstOrFail();
        
        // Marquer la commande comme annulée
        $order->update(['status' => 'cancelled']);
        
        return redirect()->route('billetterie')->with('error', 'Le paiement a été annulé.');
    }
    
    public function cancel($reference)
    {
        $order = Order::where('reference', $reference)->firstOrFail();
        
        // Marquer la commande comme annulée
        $order->update(['status' => 'cancelled']);
        
        return redirect()->route('billetterie')->with('error', 'Le paiement a été annulé.');
    }
    
    public function paymentSuccess($reference)
    {
        $order = Order::with('tickets')->where('reference', $reference)->firstOrFail();
        
        return view('pages.paiement-success', compact('order'));
    }
}