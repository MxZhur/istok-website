<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $itemsQuery = Comment::query();

        if (!empty($q)) {
            $itemsQuery->where('text', 'LIKE', '%' . trim($q) . '%', 'or');
        }

        $itemsQuery->orderByDesc('created_at');

        /**@var LengthAwarePaginator */
        $paginate = $itemsQuery->paginate(20);

        $items = $paginate->withQueryString();

        return Inertia::render('Admin/Comment/Index', [
            'items' => $items
        ]);
    }


    public function block(int $id) {
        $comment = Comment::findOrFail($id);

        $comment->is_blocked = true;
        $comment->timestamps = false;
        $comment->save();

        return back();
    }
}
