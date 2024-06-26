<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogPost\StoreRequest;
use App\Http\Requests\Admin\BlogPost\UpdateRequest;
use App\Models\BlogPost;
use App\Models\Tag;
use App\Services\BlogPostService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        return Inertia::render('Admin/Blog/Index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Blog/Create', [
            'availableTags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        StoreRequest $request,
        BlogPostService $blogPostService
    ) {
        $data = $request->validated();

        $blogPostService->store($data);

        return redirect(route('admin.blog_posts.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect(route('admin.blog_posts.edit', ['id' => $id]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = BlogPost::findOrFail($id);

        return Inertia::render('Admin/Blog/Edit', [
            'item' => $item,
            'availableTags' => Tag::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateRequest $request,
        string $id,
        BlogPostService $blogPostService
    ) {
        $item = BlogPost::findOrFail($id);

        $data = $request->validated();

        $blogPostService->update($item, $data);

        return redirect(route('admin.blog_posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = BlogPost::findOrFail($id);

        $item->delete();

        return back();
    }
}
