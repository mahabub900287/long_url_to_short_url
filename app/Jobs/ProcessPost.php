<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;
use App\Models\User;
use App\Notifications\SendPostNotify;
use Illuminate\Support\Facades\Log;

class ProcessPost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $title;
    private $description;
    private $user;
    private $photo;

    public function __construct($data, User $user)
    {
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->photo = $data['photo'];
        $this->user = $user;
    }

    public function handle(): void
    {
        Log::info("Processing post for title: " . $this->title);
        Log::info("Processing post for user: " . $this->user->email);

        Post::create([
            'title' => $this->title,
            'description' => $this->description,
            'photo' => $this->photo,
        ]);

        Log::info("Post created");

        Log::info("Sending notification to user: " . $this->user->email);
        $this->user->notify(new SendPostNotify($this->user, $this->title, $this->description,$this->photo));
        Log::info("Notification sent");
    }
}
