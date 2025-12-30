<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{
    public function index()
    {
        // Récupérer uniquement les images approuvées
        $images = Gallery::where('approved', true)->latest()->get();
        
        return view('pages.galerie', compact('images'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // Augmenté à 5MB
            'author_name' => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:500'
        ]);
        
        try {
            $imagePath = $request->file('image')->store('gallery', 'public');
            
            Gallery::create([
                'image_path' => $imagePath,
                'author_name' => $request->author_name,
                'caption' => $request->caption,
                'approved' => true // Approuver automatiquement
            ]);
            
            return redirect()->back()->with('success', 'Votre photo a été partagée avec succès!');
        } catch (\Exception $e) {
            Log::error('Error saving gallery image', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()->with('error', 'Une erreur est survenue lors du téléchargement de votre photo.');
        }
    }
}