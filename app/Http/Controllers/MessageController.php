<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Affiche les messages approuvés
     */
    public function index()
    {
        $messages = Message::where('approved', true)->latest()->get();
        return response()->json($messages);
    }
    
    /**
     * Enregistre un nouveau message
     */
    public function store(Request $request)
    {
        $request->validate([
            'author_name' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
        ]);
        
        $message = Message::create([
            'author_name' => $request->author_name,
            'content' => $request->content,
            'approved' => true // Par défaut, les messages sont automatiquement approuvés
        ]);
        
        return response()->json($message, 201);
    }
}