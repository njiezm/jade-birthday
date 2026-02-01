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
        try {
            // Validation pour les images et vidéos
            $validator = Validator::make($request->all(), [
                'media' => 'required|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240', // 10MB max
                'media_type' => 'required|in:image,video',
                'author_name' => 'nullable|string|max:255',
                'caption' => 'nullable|string|max:500'
            ]);
            
            if ($validator->fails()) {
                // Retourner les erreurs de validation détaillées pour le débogage
                $errors = $validator->errors()->all();
                $errorMessage = implode(', ', $errors);
                
                Log::error('Validation error in gallery store', [
                    'errors' => $errors,
                    'request_data' => $request->all()
                ]);
                
                // Retourner une réponse JSON avec le code 422 (Unprocessable Entity)
                return response()->json([
                    'success' => false,
                    'message' => 'Erreur de validation: ' . $errorMessage,
                    'errors' => $validator->errors()
                ], 422);
            }
            
            // Vérifier si le dossier existe, sinon le créer
            if (!Storage::disk('public')->exists('gallery')) {
                Storage::disk('public')->makeDirectory('gallery');
            }
            
            // Stocker le média avec un nom unique
            $mediaPath = $request->file('media')->store('gallery', 'public');
            
            // Initialiser le chemin de la miniature
            $thumbnailPath = null;
            
            // Créer une miniature si c'est une image
            if ($request->media_type === 'image') {
                try {
                    $thumbnailPath = $this->createThumbnail($mediaPath);
                } catch (\Exception $e) {
                    // En cas d'erreur lors de la création de la miniature, utiliser l'image originale
                    Log::warning('Impossible de créer la miniature, utilisation de l\'image originale: ' . $e->getMessage());
                    $thumbnailPath = null;
                }
            }
            
            // Créer l'entrée dans la base de données
            $galleryItem = Gallery::create([
                'image_path' => $mediaPath, // Corriger le nom de la colonne
                'media_type' => $request->media_type,
                'author_name' => $request->author_name,
                'caption' => $request->caption,
                'approved' => true, // Approuver automatiquement
                'thumbnail_path' => $thumbnailPath // Utiliser null si la création échoue
            ]);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Votre média a été partagé avec succès!',
                    'media_url' => Storage::url($mediaPath),
                    'thumbnail_url' => $thumbnailPath ? Storage::url($thumbnailPath) : Storage::url($mediaPath),
                    'id' => $galleryItem->id,
                    'type' => $request->media_type
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
                    'message' => 'Une erreur est survenue lors du téléchargement de votre média: ' . $e->getMessage()
                ], 500); // Utiliser le code 500 pour les erreurs serveur
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
            
            // Vérifier si le fichier existe
            if (!file_exists($fullPath)) {
                throw new \Exception('Le fichier source n\'existe pas: ' . $fullPath);
            }
            
            // Vérifier si l'intervention/image est installé
            if (!class_exists('\Intervention\Image\ImageManager')) {
                throw new \Exception('La bibliothèque Intervention Image n\'est pas installée');
            }
            
            // Vérifier si le dossier des miniatures existe
            if (!Storage::disk('public')->exists('thumbnails')) {
                Storage::disk('public')->makeDirectory('thumbnails');
            }
            
            // Chemin de la miniature
            $thumbnailPath = 'thumbnails/' . basename($mediaPath);
            $thumbnailFullPath = Storage::disk('public')->path($thumbnailPath);
            
            // Utiliser GD directement si Intervention Image ne fonctionne pas
            if (extension_loaded('gd') && function_exists('gd_info')) {
                // Obtenir les informations sur l'image
                $imageInfo = getimagesize($fullPath);
                
                if (!$imageInfo) {
                    throw new \Exception('Impossible de lire les informations de l\'image');
                }
                
                $width = $imageInfo[0];
                $height = $imageInfo[1];
                $type = $imageInfo[2];
                
                // Calculer les nouvelles dimensions
                $newWidth = 300;
                $newHeight = intval($height * ($newWidth / $width));
                
                // Créer une nouvelle image
                $thumb = imagecreatetruecolor($newWidth, $newHeight);
                
                // Charger l'image originale selon son type
                switch ($type) {
                    case IMAGETYPE_JPEG:
                        $source = imagecreatefromjpeg($fullPath);
                        break;
                    case IMAGETYPE_PNG:
                        $source = imagecreatefrompng($fullPath);
                        // Conserver la transparence pour les PNG
                        imagealphablending($thumb, false);
                        imagesavealpha($thumb, true);
                        break;
                    case IMAGETYPE_GIF:
                        $source = imagecreatefromgif($fullPath);
                        break;
                    default:
                        throw new \Exception('Type d\'image non supporté: ' . $type);
                }
                
                // Redimensionner
                imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                
                // Sauvegarder la miniature
                switch ($type) {
                    case IMAGETYPE_JPEG:
                        imagejpeg($thumb, $thumbnailFullPath, 85);
                        break;
                    case IMAGETYPE_PNG:
                        imagepng($thumb, $thumbnailFullPath, 8);
                        break;
                    case IMAGETYPE_GIF:
                        imagegif($thumb, $thumbnailFullPath);
                        break;
                }
                
                // Libérer la mémoire
                imagedestroy($thumb);
                imagedestroy($source);
                
                return $thumbnailPath;
            } else {
                // Si GD n'est pas disponible, essayer avec Intervention Image
                $manager = new \Intervention\Image\ImageManager(['driver' => 'gd']);
                $image = $manager->make($fullPath);
                
                // Redimensionner l'image pour la miniature
                $image->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                
                // Sauvegarder la miniature
                $image->save($thumbnailFullPath);
                
                return $thumbnailPath;
            }
        } catch (\Exception $e) {
            Log::error('Error creating thumbnail', [
                'message' => $e->getMessage(),
                'media_path' => $mediaPath
            ]);
            
            // Relancer l'exception pour que le code appelant puisse la gérer
            throw $e;
        }
    }
}