<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    
    // Spécifiez le nom de la table correct
    protected $table = 'galery';
    
    protected $fillable = [
        'image_path',
        'author_name',
        'approved'
    ];
    
    protected $casts = [
        'approved' => 'boolean'
    ];
}