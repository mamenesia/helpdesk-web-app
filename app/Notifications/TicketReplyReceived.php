<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReplyAdded extends Notification
{
    use Queueable;

    public $reply;

    public function __construct($reply)
    {
        $this->reply = $reply;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('A new reply has been added to your ticket.')
            ->action('View Reply', url('/tickets/' . $this->reply->tiket_id))
            ->line('Thank you for using our application!');
    }
}