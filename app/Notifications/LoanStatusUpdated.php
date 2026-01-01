<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoanStatusUpdated extends Notification
{
    use Queueable;

    public $loan;

    public function __construct($loan)
    {
        $this->loan = $loan;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'loan_id' => $this->loan->id,
            'title' => 'Loan Status Update',
            'message' => 'Status changed to: ' . ucfirst($this->loan->status),
            'url' => route('loans.history'),
        ];
    }
}
