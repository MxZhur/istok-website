<?php

namespace App\Http\Controllers;

use App\Models\MiniGame;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MiniGameController extends Controller
{
    public function index()
    {
        return Inertia::render('MiniGame/Index', []);
    }


    public function category(Request $request, string $category)
    {
        $q = $request->query('q');

        $itemsQuery = MiniGame::query()
            ->byCategory($category);

        if (!empty($q)) {
            $itemsQuery->where('title', 'LIKE', '%' . trim($q) . '%');
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

        return Inertia::render('MiniGame/Category', [
            'category' => $category,
            'items' => $items,
            'q' => $q,
        ]);
    }


    public function show(string $category, int $id)
    {
        $item = MiniGame::findOrFail($id);

        return Inertia::render('MiniGame/Show', [
            'item' => $item,
        ]);
    }
}
