<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('story-created', function ($user) {
    return (bool)$user;
});

Broadcast::channel('story-approved', function () {
    return true;
});
