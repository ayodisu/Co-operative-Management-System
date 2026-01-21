<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketReplyNotification extends Notification
{
    use Queueable;

    public $ticket;
    public $replierName;

    public function __construct($ticket, $replierName)
    {
        $this->ticket = $ticket;
        $this->replierName = $replierName;
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = $notifiable->id === $this->ticket->user_id
            ? route('support.show', $this->ticket->id)
            : route('admin.support.show', $this->ticket->id);

        return (new MailMessage)
            ->subject('New Reply on Ticket #' . $this->ticket->id)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line($this->replierName . ' has replied to your support ticket.')
            ->line('**Subject:** ' . $this->ticket->subject)
            ->action('View Ticket', $url)
            ->line('Thank you for using OAuGF Cooperative Society!');
    }

    public function toArray(object $notifiable): array
    {
        $url = $notifiable->id === $this->ticket->user_id
            ? route('support.show', $this->ticket->id)
            : route('admin.support.show', $this->ticket->id);

        return [
            'ticket_id' => $this->ticket->id,
            'title' => 'New reply on Ticket #' . $this->ticket->id,
            'message' => $this->replierName . ' replied to ticket.',
            'url' => $url,
        ];
    }
}
