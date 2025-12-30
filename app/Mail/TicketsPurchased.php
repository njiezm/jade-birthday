<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketsPurchased extends Mailable
{
    use Queueable, SerializesModels;
    
    public $order;
    
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    
    public function build()
    {
        return $this->subject('Vos billets pour THE 23 BELLINI FEST')
                    ->view('emails.tickets-purchased')
                    ->with([
                        'order' => $this->order
                    ]);
    }
}