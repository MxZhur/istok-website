<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\TeachingMaterial;
use App\Models\Tag;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeachingMaterialController extends Controller
{
    public function index()
    {
        return Inertia::render('TeachingMaterial/Index', []);
    }


    public function type(Request $request, string $type)
    {
        $q = $request->query('q');

        $itemsQuery = TeachingMaterial::query()
            ->byType($type);

        if (!empty($q)) {
            $itemsQuery->where('title', 'LIKE', '%' . trim($q) . '%');

            $itemsQuery->whereIn('id', function ($query) use ($q) {

                $tagsIds = Tag::query()
                    ->where('name', 'LIKE', '%' . trim($q) . '%')
                    ->pluck('id')
                    ->toArray();

                $query->select('teaching_material_id')
                    ->from('teaching_material_tag')
                    ->whereIn('tag_id', $tagsIds);

            }, 'or');
        }

        $itemsQuery->orderByDesc('created_at');

        /**@var LengthAwarePaginator */
        $paginate = $itemsQuery->paginate(20, [
            'id',
            'title',
            'type',
            'created_at',
            'updated_at',
        ]);

        $items = $paginate->withQueryString();

        return Inertia::render('TeachingMaterial/Type', [
            'type' => $type,
            'items' => $items,
        ]);
    }


    public function show(string $type, int $id, CommentService $commentService)
    {
        $item = TeachingMaterial::findOrFail($id);

        $comments = $commentService->getCommentsTree(Comment::ENTITY_TEACHING_MATERIAL, $id);

        return Inertia::render('TeachingMaterial/Show', [
            'item' => $item,
            'comments' => $comments,
        ]);
    }
}
