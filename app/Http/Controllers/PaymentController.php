<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketsPurchased;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Affiche le formulaire de réservation.
     */
    public function showForm()
    {
        return view('pages.paiement');
    }

    /**
     * Crée la commande en attente et redirige vers le lien Stripe.
     */
    public function redirectToPayment(Request $request)
    {
        // 1. Valider les informations
        $request->validate([
            'email' => 'required|email',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
        ]);

        // 2. Créer la commande en statut "pending" (en attente)
        $order = Order::create([
            'reference' => 'JADE-' . strtoupper(Str::random(8)), // Ex: JADE-1A4B9C2D
            'email' => $request->email,
            'amount' => 30,
            'status' => 'pending',
            'payment_method' => 'stripe'
        ]);

        // 3. Créer le billet associé
        Ticket::create([
            'order_id' => $order->id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'qr_code_path' => '' // Sera généré après le paiement
        ]);

        // 4. Construire l'URL de Stripe avec notre référence
        $stripeUrl = 'https://buy.stripe.com/8x2cN43L33zvgqCfPrdUY16';
        // On ajoute notre référence comme paramètre d'URL
        $paymentUrl = $stripeUrl . '?client_reference_id=' . $order->reference;

        // 5. Rediriger l'utilisateur vers cette URL personnalisée
        return redirect()->away($paymentUrl);
    }

    /**
     * Page de succès : Stripe redirige ici après le paiement.
     * C'est ici qu'on finalise tout.
     */
    public function paymentSuccess(Request $request)
    {
        // Récupérer la référence que Stripe nous a renvoyée
        $reference = $request->query('client_reference_id');

        if (!$reference) {
            Log::error('Un utilisateur est arrivé sur la page de succès sans référence.');
            return redirect()->route('billetterie')->with('error', 'Une erreur est survenue lors de la validation de votre paiement. Veuillez nous contacter.');
        }

        // Trouver la commande correspondante
        $order = Order::where('reference', $reference)->first();

        if (!$order) {
            Log::error("Aucune commande trouvée pour la référence : {$reference}");
            return redirect()->route('billetterie')->with('error', 'Commande introuvable. Veuillez nous contacter.');
        }

        // Vérifier si la commande n'a pas déjà été payée (pour éviter les doubles envois)
        if ($order->status === 'paid') {
            // Si c'est déjà payé, on le redirige simplement vers la page de succès
            return view('pages.paiement-simple-success', compact('order'));
        }

        // **POINT CRUCIAL** : On fait confiance au fait que si l'utilisateur est ici,
        // c'est que le paiement a réussi. C'est la seule preuve qu'on a sans webhook.

        // Mettre à jour la commande
        $order->update(['status' => 'paid']);

        // Générer le QR Code pour le billet
        $ticket = $order->tickets->first();
        $qrCodePath = 'qrcodes/' . $order->reference . '_' . $ticket->id . '.svg';
        $qrCodeContent = route('ticket.validate', ['reference' => $order->reference, 'id' => $ticket->id]);
        
        QrCode::format('svg')
            ->size(200)
            ->errorCorrection('H')
            ->generate($qrCodeContent, public_path($qrCodePath));
        
        $ticket->update(['qr_code_path' => $qrCodePath]);

        // Envoyer les emails (billets à l'acheteur et notification à l'admin)
        try {
            Mail::to($order->email)->send(new TicketsPurchased($order));
            Mail::to(config('mail.admin_address'))->send(new TicketsPurchased($order, true));
        } catch (\Exception $e) {
            Log::error("Erreur lors de l'envoi de l'email pour la commande {$order->reference}: " . $e->getMessage());
            // On continue même si l'email échoue, l'admin pourra le renvoyer manuellement.
        }

        // Afficher la page de succès finale
        return view('pages.paiement-simple-success', compact('order'));
    }
}