<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RepaymentReminderNotification extends Notification
{
    use Queueable;

    public $loan;
    public $dueDate;
    public $amountDue;

    public function __construct($loan, $dueDate = null, $amountDue = null)
    {
        $this->loan = $loan;
        $this->dueDate = $dueDate ?? now()->addDays(7)->format('M d, Y');
        $this->amountDue = $amountDue ?? $loan->balance_remaining;
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $amount = number_format($this->amountDue, 2);

        return (new MailMessage)
            ->subject('Loan Repayment Reminder')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('This is a friendly reminder about your upcoming loan repayment.')
            ->line('**Loan ID:** #' . $this->loan->id)
            ->line('**Amount Due:** ₦' . $amount)
            ->line('**Due Date:** ' . $this->dueDate)
            ->action('View Repayment Schedule', route('loans.schedule'))
            ->line('Please ensure timely payment to avoid any penalties.')
            ->line('Thank you for being a member of OAuGF Cooperative Society!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'loan_id' => $this->loan->id,
            'title' => 'Repayment Reminder',
            'message' => 'Reminder: ₦' . number_format($this->amountDue, 2) . ' due by ' . $this->dueDate,
            'url' => route('loans.schedule'),
        ];
    }
}
