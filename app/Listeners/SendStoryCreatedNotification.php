<?php

namespace App\Listeners;

use App\Events\StoryCreated;
use App\Mail\StoryCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendStoryCreatedNotification
{

    public function handle(StoryCreated $event): void
    {
        try {
            Mail::to('no-reply@stories.com')->queue(new StoryCreatedMail($event->story));
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error("Failed to send email for Story ID: {$event->story->id}", [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
