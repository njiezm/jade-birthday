<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
        // Validation plus stricte
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
            'author_name' => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:500'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        try {
            // Vérifier si le dossier existe, sinon le créer
            if (!Storage::disk('public')->exists('gallery')) {
                Storage::disk('public')->makeDirectory('gallery');
            }
            
            // Stocker l'image avec un nom unique pour éviter les conflits
            $imagePath = $request->file('image')->store('gallery', 'public');
            
            // Créer une miniature pour optimiser le chargement
            $this->createThumbnail($imagePath);
            
            // Créer l'entrée dans la base de données
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
    
    /**
     * Crée une miniature pour une image
     */
    private function createThumbnail($imagePath)
    {
        try {
            // Chemin complet de l'image
            $fullPath = Storage::disk('public')->path($imagePath);
            
            // Vérifier si l'intervention/image est installé
            if (class_exists('\Intervention\Image\ImageManager')) {
                $manager = new \Intervention\Image\ImageManager(['driver' => 'gd']);
                $image = $manager->make($fullPath);
                
                // Redimensionner l'image pour la miniature
                $image->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                
                // Chemin de la miniature
                $thumbnailPath = 'thumbnails/' . basename($imagePath);
                
                // Vérifier si le dossier des miniatures existe
                if (!Storage::disk('public')->exists('thumbnails')) {
                    Storage::disk('public')->makeDirectory('thumbnails');
                }
                
                // Sauvegarder la miniature
                $image->save(Storage::disk('public')->path($thumbnailPath));
            }
        } catch (\Exception $e) {
            Log::error('Error creating thumbnail', [
                'message' => $e->getMessage(),
                'image_path' => $imagePath
            ]);
            // Ne pas bloquer le processus si la création de miniature échoue
        }
    }
}