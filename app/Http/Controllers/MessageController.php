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
            
            // Formater les messages pour s'assurer que toutes les données sont présentes
            $formattedMessages = $messages->map(function ($message) {
                return [
                    'id' => $message->id,
                    'author_name' => $message->author_name,
                    'content' => $message->content,
                    'approved' => $message->approved,
                    'created_at' => $message->created_at->toISOString(),
                    'updated_at' => $message->updated_at->toISOString()
                ];
            });
            
            return response()->json($formattedMessages);
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
        try {
            $validated = $request->validate([
                'author_name' => 'nullable|string|max:255',
                'content' => 'required|string|max:2000'
            ]);
            
            $message = Message::create([
                'author_name' => $validated['author_name'],
                'content' => $validated['content'],
                'approved' => true // Les messages sont automatiquement approuvés
            ]);
            
            // Rafraîchir le modèle pour obtenir les dates mises à jour
            $message->refresh();
            
            // Retourner le message complet avec ses attributs
            return response()->json([
                'success' => true, 
                'message' => 'Message enregistré avec succès!',
                'data' => [
                    'id' => $message->id,
                    'author_name' => $message->author_name,
                    'content' => $message->content,
                    'approved' => $message->approved,
                    'created_at' => $message->created_at->toISOString(),
                    'updated_at' => $message->updated_at->toISOString()
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'enregistrement du message: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Une erreur est survenue lors de l\'enregistrement du message.'], 500);
        }
    }
}