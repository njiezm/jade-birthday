<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index()
    {
        // Récupérer uniquement les images et vidéos approuvées
        $media = Gallery::where('approved', true)->latest()->get();
        
        return view('pages.galerie', compact('media'));
    }
    
    public function store(Request $request)
    {
        // Validation pour les images et vidéos
        $validator = Validator::make($request->all(), [
            'media' => 'required|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240', // 10MB max
            'media_type' => 'required|in:image,video',
            'author_name' => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:500'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }
        
        try {
            // Vérifier si le dossier existe, sinon le créer
            if (!Storage::disk('public')->exists('gallery')) {
                Storage::disk('public')->makeDirectory('gallery');
            }
            
            // Stocker le média avec un nom unique
            $mediaPath = $request->file('media')->store('gallery', 'public');
            
            // Créer une miniature si c'est une image
            if ($request->media_type === 'image') {
                $thumbnailPath = $this->createThumbnail($mediaPath);
            }
            
            // Créer l'entrée dans la base de données
            $galleryItem = Gallery::create([
                'media_path' => $mediaPath,
                'media_type' => $request->media_type,
                'author_name' => $request->author_name,
                'caption' => $request->caption,
                'approved' => true, // Approuver automatiquement
                'thumbnail_path' => $thumbnailPath ?? null // Ajouter le chemin de la miniature
            ]);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Votre média a été partagé avec succès!',
                    'media_url' => Storage::url($mediaPath),
                    'thumbnail_url' => isset($thumbnailPath) ? Storage::url($thumbnailPath) : null,
                    'id' => $galleryItem->id
                ]);
            }
            
            return redirect()->back()->with('success', 'Votre média a été partagé avec succès!');
        } catch (\Exception $e) {
            Log::error('Error saving gallery media', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Une erreur est survenue lors du téléchargement de votre média.'
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Une erreur est survenue lors du téléchargement de votre média.');
        }
    }
    
    /**
     * Crée une miniature pour une image et retourne son chemin
     */
    private function createThumbnail($mediaPath)
    {
        try {
            // Chemin complet du média
            $fullPath = Storage::disk('public')->path($mediaPath);
            
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
                $thumbnailPath = 'thumbnails/' . basename($mediaPath);
                
                // Vérifier si le dossier des miniatures existe
                if (!Storage::disk('public')->exists('thumbnails')) {
                    Storage::disk('public')->makeDirectory('thumbnails');
                }
                
                // Sauvegarder la miniature - CORRECTION IMPORTANTE
                $image->save(Storage::disk('public')->path($thumbnailPath));
                
                return $thumbnailPath;
            }
            
            return null;
        } catch (\Exception $e) {
            Log::error('Error creating thumbnail', [
                'message' => $e->getMessage(),
                'media_path' => $mediaPath
            ]);
            // Ne pas bloquer le processus si la création de miniature échoue
            return null;
        }
    }
}