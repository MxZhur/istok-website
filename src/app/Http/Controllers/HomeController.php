<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $latestBlogPost = BlogPost::query()
            ->latest()
            ->first();

        $otherBlogPosts = BlogPost::query()
            ->orderByDesc('created_at')
            ->skip(1)
            ->take(10)
            ->get();

        return Inertia::render('Home', [
            'latestBlogPost' => $latestBlogPost,
            'otherBlogPosts' => $otherBlogPosts,
        ]);
    }
}
