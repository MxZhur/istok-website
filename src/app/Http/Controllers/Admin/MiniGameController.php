<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MiniGame\StoreRequest;
use App\Http\Requests\Admin\MiniGame\UpdateRequest;
use App\Models\MiniGame;
use App\Services\MiniGameService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MiniGameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->query('q');
        $category = $request->query('category');

        $itemsQuery = MiniGame::query();

        if (!empty($q)) {
            $itemsQuery->where('title', 'LIKE', '%' . trim($q) . '%', 'or');
        }

        if (!empty($category)) {
            $itemsQuery->byCategory($category);
        }

        $itemsQuery->orderByDesc('created_at');

        /**@var LengthAwarePaginator */
        $paginate = $itemsQuery->paginate(20, [
            'id',
            'title',
            'category',
            'created_at',
            'updated_at',
        ]);

        $items = $paginate->withQueryString();

        return Inertia::render('Admin/MiniGame/Index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/MiniGame/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        StoreRequest $request,
        MiniGameService $miniGameService
    ) {
        $data = $request->validated();

        $miniGameService->store($data);

        return redirect(route('admin.mini_games.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect(route('admin.mini_games.edit', ['id' => $id]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = MiniGame::findOrFail($id);

        return Inertia::render('Admin/MiniGame/Edit', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateRequest $request,
        string $id,
        MiniGameService $miniGameService
    ) {
        $item = MiniGame::findOrFail($id);

        $data = $request->validated();

        $miniGameService->update($item, $data);

        return redirect(route('admin.mini_games.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = MiniGame::findOrFail($id);

        $item->delete();

        return back();
    }
}
