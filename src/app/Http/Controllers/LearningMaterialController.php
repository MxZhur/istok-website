<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\LearningMaterial;
use App\Models\Tag;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LearningMaterialController extends Controller
{
    public function index()
    {
        return Inertia::render('LearningMaterial/Index', []);
    }


    public function grade(Request $request, int $grade)
    {
        $q = $request->query('q');

        $itemsQuery = LearningMaterial::query()
            ->byGrade($grade);

        if (!empty($q)) {
            $itemsQuery->where('title', 'LIKE', '%' . trim($q) . '%');

            $itemsQuery->whereIn('id', function ($query) use ($q) {

                $tagsIds = Tag::query()
                    ->where('name', 'LIKE', '%' . trim($q) . '%')
                    ->pluck('id')
                    ->toArray();

                $query->select('learning_material_id')
                    ->from('learning_material_tag')
                    ->whereIn('tag_id', $tagsIds);

            }, 'or');
        }

        $itemsQuery->orderByDesc('created_at');

        /**@var LengthAwarePaginator */
        $paginate = $itemsQuery->paginate(20, [
            'id',
            'title',
            'grade',
            'created_at',
            'updated_at',
        ]);

        $items = $paginate->withQueryString();

        $tags = Tag::query()
            ->byEntityType(Tag::ENTITY_LEARNING_MATERIAL)
            ->orderBy('name')
            ->get();

        return Inertia::render('LearningMaterial/Grade', [
            'grade' => $grade,
            'items' => $items,
            'tags' => $tags,
            'q' => $q,
        ]);
    }


    public function show(int $grade, int $id, CommentService $commentService)
    {
        $item = LearningMaterial::findOrFail($id);

        $comments = $commentService->getCommentsTree(Comment::ENTITY_LEARNING_MATERIAL, $id);

        return Inertia::render('LearningMaterial/Show', [
            'item' => $item,
            'comments' => $comments,
        ]);
    }
}
