<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    public function index() {
        $latestComments = Comment::query()
            ->orderByDesc('created_at')
            ->take(20)
            ->get();

        // TODO: $latestFeedback

        return Inertia::render('Admin/Dashboard', [
            'latestComments' => $latestComments,
            // TODO: 'latestFeedback' => $latestFeedback,
        ]);
    }
}
