<?php

namespace App\Notifications;

use App\Mail\Orders\NewOrderForCustomer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NewOrderForCustomer
     */
    public function toMail($notifiable)
    {
        return (new NewOrderForCustomer($notifiable->id, $notifiable->user->name))->to($notifiable->user);
    }
}
