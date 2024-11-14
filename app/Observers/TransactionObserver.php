<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Notifications\OrderCompleted;

use Illuminate\Support\Facades\Log;

class TransactionObserver
{
    public function updated(Transaction $transaction)
    {
        if ($transaction->isDirty('status') && $transaction->status === 'Completed') {
            Log::info("Status updated to Completed for Transaction #{$transaction->id}");
            if ($transaction->user) {
                $transaction->user->notify(new OrderCompleted($transaction));
            } else {
                Log::warning("No user associated with Transaction #{$transaction->id}");
            }
        }
    }
}
