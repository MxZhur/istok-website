<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\Tag;
use App\Services\CommentService;
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

        $tags = Tag::query()
            ->byEntityType(Tag::ENTITY_BLOG)
            ->orderBy('name')
            ->get();

        return Inertia::render('Blog/Index', [
            'items' => $items,
            'q' => $q,
            'tags' => $tags,
        ]);
    }


    public function show(string $id, CommentService $commentService) {
        $item = BlogPost::findOrFail($id);

        $comments = $commentService->getCommentsTree(Comment::ENTITY_BLOG_POST, $id);

        return Inertia::render('Blog/Show', [
            'item' => $item,
            'comments' => $comments,
        ]);
    }
}
