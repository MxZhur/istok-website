<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExpertClub\StoreRequest;
use App\Http\Requests\Admin\ExpertClub\UpdateRequest;
use App\Models\ExpertClubEntry;
use App\Models\Tag;
use App\Services\ExpertClubService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExpertClubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        return Inertia::render('Admin/ExpertClub/Index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/ExpertClub/Create', [
            'availableTags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        StoreRequest $request,
        ExpertClubService $expertClubService
    ) {
        $data = $request->validated();

        $expertClubService->store($data);

        return redirect(route('admin.expert_club.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect(route('admin.expert_club.edit', ['id' => $id]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = ExpertClubEntry::findOrFail($id);

        return Inertia::render('Admin/ExpertClub/Edit', [
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
        ExpertClubService $expertClubService
    ) {
        $item = ExpertClubEntry::findOrFail($id);

        $data = $request->validated();

        $expertClubService->update($item, $data);

        return redirect(route('admin.expert_club.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = ExpertClubEntry::findOrFail($id);

        $item->delete();

        return back();
    }
}
