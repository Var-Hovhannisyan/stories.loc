<?php

namespace App\Http\Controllers;

use App\Events\StoryApproved;
use App\Events\StoryCreated;
use App\Interfaces\StoryActionsInterface;
use App\Models\Story;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    protected StoryActionsInterface $storyActionService;

    public function __construct(StoryActionsInterface $storyActionService)
    {
        $this->storyActionService = $storyActionService;
    }

    public function store(Request $request): ?JsonResponse
    {
        $story = $this->storyActionService->createStory();
        if (!$story) {
            return response()->json(['message' => 'Story not created', 'story' => null], 400);
        }
        broadcast(new StoryCreated($story));
        return response()->json(['message' => 'Story created', 'story' => $story->toArray()], 201);
    }

    public function approve(Story $story)
    {
        try {
            // Update story approval status
            $story->update(['is_approved' => true]);

            // Optionally, broadcast the approval to notify others (if needed)
//            broadcast(new StoryApproved($story));

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Handle any errors and respond accordingly
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function approved(int $storyId)
    {
        $story = $this->storyActionService->approveStory($storyId);

        if (!$story) {
            return redirect()->route('home')->with('error', 'Story not found or already approved.');
        }

        return view('story.approved', ['story' => $story->toArray()]);
    }


}
