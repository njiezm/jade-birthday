<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ticket;
use App\Services\SumUpService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketsPurchased;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    private $sumupService;
    
    public function __construct(SumUpService $sumupService)
    {
        $this->sumupService = $sumupService;
    }
    
    public function store(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'tickets' => 'required|array|min:1',
                'tickets.*.firstname' => 'required|string|max:255',
                'tickets.*.lastname' => 'required|string|max:255',
                'payment_method' => 'required|in:sumup,cash',
            ]);
            
            // Calculer le montant total - MODIFIÉ À 30€
            $amount = count($request->tickets) * 30; // 30€ par billet
            
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
            if ($request->payment_method === 'sumup') {
                return $this->processSumUpPayment($order, $amount, $request->email);
            } else {
                return $this->processCashPayment($order, $amount);
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
    
    private function processSumUpPayment($order, $amount, $email)
    {
        try {
            // Créer une session de paiement SumUp
            $checkout = $this->sumupService->createCheckout(
                $amount,
                $email,
                route('sumup.success', ['reference' => $order->reference]),
                route('sumup.cancel', ['reference' => $order->reference])
            );
            
            // Stocker l'ID de la session SumUp
            $order->update(['sumup_checkout_id' => $checkout->id]);
            
            // Retourner les informations de la session SumUp
            return response()->json([
                'success' => true,
                'checkout_id' => $checkout->id,
                'amount' => $amount,
                'reference' => $order->reference
            ]);
            
        } catch (\Exception $e) {
            Log::error('SumUp error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de la session SumUp: ' . $e->getMessage()
            ], 500);
        }
    }
    
    private function processCashPayment($order, $amount)
    {
        try {
            // Pour le paiement en espèces, nous considérons que la commande est confirmée
            // mais en attente de paiement
            $order->update(['status' => 'cash_pending']);
            
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
            Mail::to(config('mail.admin_address'))->send(new TicketsPurchased($order, true));
            
            return response()->json([
                'success' => true,
                'reference' => $order->reference
            ]);
            
        } catch (\Exception $e) {
            Log::error('Cash payment error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du traitement du paiement en espèces: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function sumupSuccess(Request $request, $reference)
    {
        try {
            $order = Order::where('reference', $reference)->firstOrFail();
            
            if (!$order->sumup_checkout_id) {
                return redirect()->route('billetterie')->with('error', 'Commande invalide.');
            }
            
            // Vérifier le statut du paiement avec SumUp
            $checkout = $this->sumupService->getCheckout($order->sumup_checkout_id);
            
            if ($checkout->status === 'PAID') {
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
                Mail::to(config('mail.admin_address'))->send(new TicketsPurchased($order, true));
                
                return redirect()->route('paiement.success', ['reference' => $order->reference])
                    ->with('success', 'Paiement effectué avec succès! Vos billets ont été envoyés par email.');
            } else {
                return redirect()->route('billetterie')->with('error', 'Le paiement n\'a pas pu être validé.');
            }
            
        } catch (\Exception $e) {
            Log::error('SumUp success error: ' . $e->getMessage());
            return redirect()->route('billetterie')->with('error', 'Erreur lors de la validation du paiement: ' . $e->getMessage());
        }
    }
    
    public function sumupCancel($reference)
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