<?php

namespace App\Http\Controllers;

use App\Events\StoryCreated;
use App\Models\Story;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json(Story::where('is_approved', true)->latest()->get());
        }
        $stories = Story::where('is_approved', true)->latest()->get();
        return view('welcome', compact('stories'));
    }
}
