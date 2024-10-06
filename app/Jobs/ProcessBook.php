<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\Book;

class ProcessBook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $title;
    private $description;
    private $photo;

    /**
     * Create a new job instance.
     */
    public function __construct(array $data)
    {
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->photo = $data['photo'];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("processing");
        Book::create([
            'title' => $this->title,
            'description' => $this->description,
            'photo' => $this->photo,
        ]);
         Log::info("procesed");
    }
}
