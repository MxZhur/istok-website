<?php

namespace App\Http\Controllers;

use App\Http\Requests\Feedback\StoreRequest;
use App\Models\FeedbackEntry;
use Inertia\Inertia;

class FeedbackController extends Controller
{
    public function create()
    {
        return Inertia::render('Feedback/Create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        FeedbackEntry::create($data);

        return back();
    }
}
