<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\FeedbackEntry;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    public function index() {
        $latestComments = Comment::query()
            ->orderByDesc('created_at')
            ->take(20)
            ->get();

        $latestFeedback = FeedbackEntry::query()
            ->orderByDesc('created_at')
            ->take(20)
            ->get();

        return Inertia::render('Admin/Dashboard', [
            'latestComments' => $latestComments,
            'latestFeedback' => $latestFeedback,
        ]);
    }
}
