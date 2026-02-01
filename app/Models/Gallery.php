<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    
    protected $table = 'galery'; // Corriger le nom de la table
    
    protected $fillable = [
        'image_path', // Corriger le nom de la colonne
        'author_name',
        'approved',
        'caption',
        'media_type',
        'filter_name',
        'thumbnail_path'
    ];
    
    // Ajouter des accesseurs pour la compatibilité avec la vue
    public function getMediaUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }
    
    public function getThumbnailUrlAttribute()
    {
        // Si thumbnail_path est null, utiliser l'image originale
        return $this->thumbnail_path 
            ? asset('storage/' . $this->thumbnail_path) 
            : asset('storage/' . $this->image_path);
    }
    
    public function getIsVideoAttribute()
    {
        return $this->media_type === 'video';
    }
    
    // Formater la date
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }
}