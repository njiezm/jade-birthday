<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_id',
        'firstname',
        'lastname',
        'qr_code_path',
        'used_at'
    ];
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    public function isUsed()
    {
        return !is_null($this->used_at);
    }
}