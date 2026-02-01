<?php

namespace App\Http\Controllers;

use App\Models\Dotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WishlistController extends Controller
{
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
                'payment_method' => 'required|in:transfer,inperson'
            ]);
            
            // Créer une référence pour la donation
            $reference = 'JBD-' . strtoupper(uniqid());
            
            // Enregistrer la donation dans la base de données
            Dotation::create([
                'reference' => $reference,
                'name' => $request->name,
                'email' => $request->email,
                'amount' => $request->amount,
                'message' => $request->message,
                'type' => $request->type,
                'payment_method' => $request->payment_method,
                'status' => $request->payment_method === 'transfer' ? 'pending' : 'paid'
            ]);
            
            return response()->json([
                'success' => true,
                'message' => $request->payment_method === 'transfer' 
                    ? 'Merci pour votre intention de cadeau ! Vous recevrez les informations pour le virement.' 
                    : 'Merci pour votre générosité ! Votre cadeau a été enregistré.'
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error: ' . implode(', ', $e->errors())
            ], 422);
        } catch (\Exception $e) {
            Log::error('Wishlist error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue: ' . $e->getMessage()
            ], 500);
        }
    }
}