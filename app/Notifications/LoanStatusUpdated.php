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
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $status = ucfirst($this->loan->status);
        $amount = number_format($this->loan->amount, 2);

        $message = (new MailMessage)
            ->subject('Loan Application ' . $status)
            ->greeting('Hello ' . $notifiable->name . ',');

        if ($this->loan->status === 'approved') {
            $message->line('Great news! Your loan application has been **approved**.')
                ->line('**Loan Amount:** ₦' . $amount)
                ->line('The funds have been credited to your account.');
        } elseif ($this->loan->status === 'rejected') {
            $message->line('We regret to inform you that your loan application has been **rejected**.')
                ->line('**Loan Amount Requested:** ₦' . $amount);

            if ($this->loan->admin_remark) {
                $message->line('**Reason:** ' . $this->loan->admin_remark);
            }

            $message->line('Please contact support if you have any questions.');
        } else {
            $message->line('Your loan status has been updated to: **' . $status . '**');
        }

        return $message
            ->action('View Loan History', route('loans.history'))
            ->line('Thank you for being a member of OAuGF Cooperative Society!');
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
