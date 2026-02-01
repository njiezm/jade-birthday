<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Affiche les messages approuvés
     */
    public function index()
    {
        try {
            // Vérifier si la table existe
            if (!DB::table('information_schema.tables')->where('table_schema', DB::getDatabaseName())->where('table_name', 'messages')->exists()) {
                // Retourner un tableau vide si la table n'existe pas
                return response()->json([]);
            }
            
            $messages = Message::where('approved', true)->latest()->get();
            return response()->json($messages);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des messages: ' . $e->getMessage());
            
            // Retourner un tableau vide en cas d'erreur
            return response()->json([]);
        }
    }
    
    /**
     * Enregistre un nouveau message
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'author_name' => 'nullable|string|max:255',
            'content' => 'required|string|max:2000'
        ]);
            $message = Message::create([
                'author_name' => $validated['author_name'],
                'content' => $validated['content'],
                'approved' => true // Les messages sont automatiquement approuvés
            ]);
            
            return response()->json(['success' => true, 'message' => 'Message enregistré avec succès!']);
    }
}