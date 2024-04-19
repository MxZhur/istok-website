<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $latestBlogPost = BlogPost::query()->latest()->first();

        return Inertia::render('Home', [
            'latestBlogPost' => $latestBlogPost,
        ]);
    }
}
