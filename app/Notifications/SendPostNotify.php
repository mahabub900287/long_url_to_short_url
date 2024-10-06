<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\VonageMessage;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class SendPostNotify extends Notification implements ShouldQueue
{
    use Queueable;

    private $user;
    private $title;
    private $description;
    private $photo;

    public function __construct($user, $title, $description,$photo)
    {
        $this->user = $user;
        $this->title = $title;
        $this->description = $description;
        $this->photo = $photo;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $photoUrl = Storage::url($this->photo);

        return (new MailMessage)
            ->line('Dear ' . $this->user->name)
            ->line('A new post has been created with the title: ' . $this->title)
            ->line('Description: ' . $this->description)
            ->line('Thank you for using our application!')
            ->line('Advanced Laravel')
            ->line('<img src="' . $photoUrl . '" alt="Image" />');
    }



    public function toVonage($notifiable)
    {
        return (new VonageMessage)
            ->content('Your SMS message content');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
