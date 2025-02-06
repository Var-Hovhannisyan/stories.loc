<?php

namespace App\Services;

use App\Events\StoryApproved;
use App\Interfaces\StoryActionsInterface;
use App\Models\Story;
use App\Traits\ValidateStory;
use Illuminate\Database\Eloquent\BroadcastsEvents;

class StoryActionService implements StoryActionsInterface
{
    use ValidateStory, BroadcastsEvents;
    public function createStory(): ?Story {
        $validated = $this->validateStory();
        if($validated['code'] == 422) {
            return null;
        }
        return Story::create($validated['data']);
    }

    public function approveStory(int $storyId): ?Story
    {
        try {
            // Find the story, ensuring it exists
            $story = Story::where('id', $storyId)->where('is_approved', false)->first();

            if (!$story) {
                return null; // Return null if not found or already approved
            }

            // Update story approval status
            $story->update(['is_approved' => true]);

            // Broadcast event for real-time updates (if using WebSockets)
            event(new StoryApproved($story));

            return $story; // Return the updated story
        } catch (\Exception $e) {
            Log::error("Story approval failed: {$e->getMessage()}");
            return null; // Return null on failure
        }
    }
}
