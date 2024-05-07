<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuizController extends Controller
{
    public function index()
    {
        return Inertia::render('Quiz/Index', []);
    }

    public function type(Request $request, string $type)
    {
        $q = $request->query('q');

        $itemsQuery = Quiz::query()
            ->byType($type);

        if (!empty($q)) {
            $itemsQuery->where('title', 'LIKE', '%' . trim($q) . '%');
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

        return Inertia::render('Quiz/Type', [
            'type' => $type,
            'items' => $items,
        ]);
    }


    public function show(string $type, int $id)
    {
        $item = Quiz::findOrFail($id);

        return Inertia::render('Quiz/Show', [
            'item' => $item,
        ]);
    }
}
