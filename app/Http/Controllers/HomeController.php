<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Affiche la page d'accueil avec les messages
     */
    public function index()
    {
        // Charger les messages approuvés
        $messages = Message::where('approved', true)->latest()->get();
        
        // Retourner la vue avec les messages
        return view('pages.home', compact('messages'));
    }
}