<?php

namespace App\Interfaces;

use App\Models\Story;

interface StoryActionsInterface
{

    public function createStory(): ?Story;
    public function approveStory(int $id): ?Story;
}
