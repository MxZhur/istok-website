<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $itemsQuery = BlogPost::query();

        if (!empty($q)) {
            $itemsQuery->where('title', 'LIKE', '%' . trim($q) . '%', 'or');

            $itemsQuery->whereIn('id', function ($query) use ($q) {

                $tagsIds = Tag::query()
                    ->where('name', 'LIKE', '%' . trim($q) . '%')
                    ->pluck('id')
                    ->toArray();

                $query->select('blog_post_id')
                    ->from('blog_post_tag')
                    ->whereIn('tag_id', $tagsIds);

            }, 'or');
        }

        $itemsQuery->orderByDesc('created_at');

        /**@var LengthAwarePaginator */
        $paginate = $itemsQuery->paginate(20, [
            'id',
            'title',
            'created_at',
            'updated_at',
        ]);

        $items = $paginate->withQueryString();

        return Inertia::render('Blog/Index', [
            'items' => $items
        ]);
    }


    public function show(string $id) {
        $item = BlogPost::findOrFail($id);

        $comments = Comment::root()
            ->byEntity(Comment::ENTITY_BLOG_POST, $id)
            ->orderByDesc('created_at')
            ->with('children')
            ->get();

        return Inertia::render('Blog/Show', [
            'item' => $item,
            'comments' => $comments,
        ]);
    }
}
