<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderCompleted extends Notification
{
    use Queueable;

    private $transaction;

    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'transaction_id' => $this->transaction->id,
            'message' => "Your order #{$this->transaction->id} is ready for pickup.",
        ];
    }
}
