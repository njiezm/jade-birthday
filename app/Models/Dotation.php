<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dotation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'reference',
        'name',
        'email',
        'amount',
        'message',
        'type',
        'status'
    ];
    
    protected $casts = [
        'amount' => 'decimal:2'
    ];
    
    public function isPaid()
    {
        return $this->status === 'paid';
    }
    
    public function isPending()
    {
        return $this->status === 'pending';
    }
}