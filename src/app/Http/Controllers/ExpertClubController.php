<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\ExpertClubEntry;
use App\Models\Tag;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExpertClubController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $itemsQuery = ExpertClubEntry::query();

        if (!empty($q)) {
            $itemsQuery->where('title', 'LIKE', '%' . trim($q) . '%', 'or');

            $itemsQuery->whereIn('id', function ($query) use ($q) {

                $tagsIds = Tag::query()
                    ->where('name', 'LIKE', '%' . trim($q) . '%')
                    ->pluck('id')
                    ->toArray();

                $query->select('expert_club_entry_id')
                    ->from('expert_club_entry_tag')
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

        return Inertia::render('ExpertClub/Index', [
            'items' => $items
        ]);
    }


    public function show(string $id, CommentService $commentService) {
        $item = ExpertClubEntry::findOrFail($id);

        $comments = $commentService->getCommentsTree(Comment::ENTITY_EXPERT_CLUB, $id);

        return Inertia::render('ExpertClub/Show', [
            'item' => $item,
            'comments' => $comments,
        ]);
    }
}
