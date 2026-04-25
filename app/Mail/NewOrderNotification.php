<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order)
    {
        $this->subject('New Order #' . $order->id . ' - ' . $order->name);
    }

    public function build(): static
    {
        return $this->view('emails.new-order')
            ->with([
                'order' => $this->order,
                'items' => $this->order->items,
            ]);
    }
}
