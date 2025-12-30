<?php

namespace App\Http\Controllers;

use App\Models\Dotation;
use App\Services\PayPalService;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WishlistController extends Controller
{
    private $paypalService;
    private $stripeService;
    
    public function __construct(PayPalService $paypalService, StripeService $stripeService)
    {
        $this->paypalService = $paypalService;
        $this->stripeService = $stripeService;
    }
    public function index()
    {
        $recentDonations = Dotation::where('status', 'paid')
            ->latest()
            ->take(5)
            ->get();

        return view('pages.wishlist', compact('recentDonations'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'amount' => 'required|numeric|min:1',
                'message' => 'nullable|string|max:1000',
                'type' => 'required|in:contribution,bottle,music,photoshoot',
                'payment_method' => 'required|in:paypal,stripe'
            ]);
            
            // Créer une référence pour la donation
            $reference = 'JBD-' . strtoupper(uniqid());
            
            // Traiter selon la méthode de paiement
            if ($request->payment_method === 'paypal') {
                return $this->processPayPalPayment($request, $reference);
            } else {
                return $this->processStripePayment($request, $reference);
            }
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error: ' . implode(', ', $e->errors())
            ], 422);
        } catch (\Exception $e) {
            Log::error('Wishlist payment error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue: ' . $e->getMessage()
            ], 500);
        }
    }
    
    private function processPayPalPayment($request, $reference)
    {
        try {
            $paypalOrder = $this->paypalService->createOrder(
                $request->amount,
                route('wishlist.success', ['reference' => $reference]),
                route('wishlist.cancel', ['reference' => $reference])
            );
            
            // Stocker temporairement les données de la donation en session
            session([
                'wishlist_data' => [
                    'reference' => $reference,
                    'name' => $request->name,
                    'email' => $request->email,
                    'amount' => $request->amount,
                    'message' => $request->message,
                    'type' => $request->type,
                    'paypal_order_id' => $paypalOrder->result->id
                ]
            ]);
            
            return response()->json([
                'success' => true,
                'orderID' => $paypalOrder->result->id
            ]);
            
        } catch (\Exception $e) {
            Log::error('PayPal wishlist error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de la commande PayPal: ' . $e->getMessage()
            ], 500);
        }
    }
    
    private function processStripePayment($request, $reference)
    {
        try {
            $session = $this->stripeService->createCheckoutSession(
                $request->amount,
                $request->email,
                route('wishlist.success', ['reference' => $reference]),
                route('wishlist.cancel', ['reference' => $reference]),
                [
                    'reference' => $reference,
                    'type' => $request->type,
                    'name' => $request->name
                ]
            );
            
            // Stocker temporairement les données de la donation en session
            session([
                'wishlist_data' => [
                    'reference' => $reference,
                    'name' => $request->name,
                    'email' => $request->email,
                    'amount' => $request->amount,
                    'message' => $request->message,
                    'type' => $request->type,
                    'stripe_session_id' => $session->id
                ]
            ]);
            
            return response()->json([
                'success' => true,
                'redirect_url' => $session->url
            ]);
            
        } catch (\Exception $e) {
            Log::error('Stripe wishlist error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de la session Stripe: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function success(Request $request, $reference)
    {
        try {
            $wishlistData = session('wishlist_data');
            
            if (!$wishlistData || $wishlistData['reference'] !== $reference) {
                return redirect()->route('wishlist')->with('error', 'Donation invalide.');
            }
            
            // Créer la donation dans la base de données
            Dotation::create([
                'reference' => $reference,
                'name' => $wishlistData['name'],
                'email' => $wishlistData['email'],
                'amount' => $wishlistData['amount'],
                'message' => $wishlistData['message'],
                'type' => $wishlistData['type'],
                'status' => 'paid'
            ]);
            
            // Effacer les données de la session
            session()->forget('wishlist_data');
            
            return redirect()->route('wishlist')->with('success', 'Merci pour votre générosité! Votre contribution a été enregistrée.');
            
        } catch (\Exception $e) {
            Log::error('Wishlist success error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('wishlist')->with('error', 'Erreur lors de la validation du paiement: ' . $e->getMessage());
        }
    }
    
    public function cancel($reference)
    {
        // Effacer les données de la session
        session()->forget('wishlist_data');
        
        return redirect()->route('wishlist')->with('error', 'Le paiement a été annulé.');
    }
}