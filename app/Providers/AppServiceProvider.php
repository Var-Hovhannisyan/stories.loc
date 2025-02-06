<?php

namespace App\Providers;

use App\Events\StoryCreated;
use App\Interfaces\StoryActionsInterface;
use App\Listeners\SendStoryCreatedNotification;
use App\Services\StoryActionService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(StoryActionsInterface::class, StoryActionService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
