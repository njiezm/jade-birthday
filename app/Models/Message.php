<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Message extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'author_name',
        'content',
        'approved'
    ];
    
    // Ajouter des casts pour s'assurer que les dates sont correctement formatées
    protected $casts = [
        'approved' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    
    // S'assurer que les dates sont sérialisées au format ISO
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->toISOString();
    }
}