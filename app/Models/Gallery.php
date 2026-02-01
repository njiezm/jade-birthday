<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'galery';
    protected $fillable = [
        'media_path',
        'media_type',
        'author_name',
        'caption',
        'approved',
        'thumbnail_path'
    ];
    
    protected $casts = [
        'approved' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    
    /**
     * Obtenir l'URL de la miniature si elle existe, sinon retourner l'URL du média
     */
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail_path && Storage::disk('public')->exists($this->thumbnail_path)) {
            return Storage::url($this->thumbnail_path);
        }
        
        // Pour les vidéos, retourner une image par défaut
        if ($this->is_video) {
            return asset('images/video-placeholder.jpg');
        }
        
        // Pour les images sans miniature, retourner l'image originale
        return Storage::url($this->media_path);
    }
    
    /**
     * Vérifier si le média est une vidéo
     */
    public function getIsVideoAttribute()
    {
        return $this->media_type === 'video';
    }
    
    /**
     * Obtenir l'URL du média
     */
    public function getMediaUrlAttribute()
    {
        return Storage::url($this->media_path);
    }
}