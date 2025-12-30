<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TicketController extends Controller
{
    /**
     * Valide un billet en fonction de la référence de la commande et de l'ID du billet.
     */
    public function validate($reference, $id)
    {
        // 1. Trouver la commande par sa référence
        $order = Order::where('reference', $reference)->firstOrFail();

        // 2. Trouver le billet associé à cette commande et avec cet ID
        $ticket = $order->tickets()->findOrFail($id);

        // 3. Vérifier si le billet a déjà été utilisé
        if ($ticket->isUsed()) {
            return view('pages.ticket-validate', [
                'ticket' => $ticket,
                'order' => $order,
                'status' => 'already_used',
                'message' => 'Ce billet a déjà été utilisé.'
            ]);
        }

        // 4. Marquer le billet comme utilisé
        $ticket->update(['used_at' => now()]);

        // 5. Afficher la page de validation réussie
        return view('pages.ticket-validate', [
            'ticket' => $ticket,
            'order' => $order,
            'status' => 'success',
            'message' => 'Bienvenue à la fête ! Amusez-vous bien !'
        ]);
    }

    /**
 * Génère et télécharge le billet au format PDF.
 */
public function downloadPdf(Ticket $ticket)
{
    // Charger la commande associée au billet
    $order = $ticket->order;
    
    // Obtenir le chemin absolu du QR code
    $qrCodePath = public_path($ticket->qr_code_path);
    
    // Vérifier si le fichier existe
    if (!file_exists($qrCodePath)) {
        return abort(404, 'QR Code non trouvé');
    }
    
    // Générer le PDF à partir d'une vue
    $pdf = PDF::loadView('pdf.ticket', compact('ticket', 'order', 'qrCodePath'));
    
    // Télécharger le fichier avec un nom personnalisé
    return $pdf->download('billet-' . $ticket->firstname . '-' . $ticket->lastname . '.pdf');
}
}