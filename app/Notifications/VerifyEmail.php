<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\VonageMessage;
use App\Models\User;

class VerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail', 'vonage'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Dear ' . $this->user->name)
            ->line('Your account has been created. Please login here:')
            ->action('Login', url('/login'))
            ->line('Thank you for using our application!')
            ->line('Advanced Laravel');
    }

    public function toVonage($notifiable)
    {
        return (new VonageMessage)
            ->content('Your SMS message content, ' . $this->user->name);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
