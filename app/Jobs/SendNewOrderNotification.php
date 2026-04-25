<?php

namespace App\Jobs;

use App\Mail\NewOrderNotification;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewOrderNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 60;

    public function __construct(
        public Order $order,
        public string $recipientEmail,
    ) {}

    public function handle(): void
    {
        Mail::to($this->recipientEmail)
            ->send(new NewOrderNotification($this->order));
    }
}
