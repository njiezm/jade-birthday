<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'reference',
        'email',
        'amount',
        'status',
        'paypal_order_id',
        'stripe_session_id',
        'payment_method'
    ];
    
    protected $casts = [
        'amount' => 'decimal:2',
    ];
    
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    
    public static function generateReference()
    {
        return 'JBF-' . strtoupper(uniqid());
    }
    
    public function isPaid()
    {
        return $this->status === 'paid';
    }
    
    public function isPending()
    {
        return $this->status === 'pending';
    }
    
    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }
}