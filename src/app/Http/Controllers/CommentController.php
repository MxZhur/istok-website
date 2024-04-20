<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreRequest $request) {
        $data = $request->validated();

        Comment::create($data);

        return back();
    }
}
