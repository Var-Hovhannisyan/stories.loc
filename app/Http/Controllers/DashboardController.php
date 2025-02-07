<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function form() {
        return view('dashboard');
    }

    public function stories() {
        return view('dashboard_stories');
    }
}
