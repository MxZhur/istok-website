<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Quiz\StoreRequest;
use App\Http\Requests\Admin\Quiz\UpdateRequest;
use App\Models\Quiz;
use App\Services\QuizService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->query('q');
        $type = $request->query('type');

        $itemsQuery = Quiz::query();

        if (!empty($q)) {
            $itemsQuery->where('title', 'LIKE', '%' . trim($q) . '%', 'or');
        }

        if (!empty($type)) {
            $itemsQuery->byType($type);
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

        return Inertia::render('Admin/Quiz/Index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Quiz/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        StoreRequest $request,
        QuizService $quizService
    ) {
        $data = $request->validated();

        $quizService->store($data);

        return redirect(route('admin.quizzes.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect(route('admin.quizzes.edit', ['id' => $id]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Quiz::findOrFail($id);

        return Inertia::render('Admin/Quiz/Edit', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateRequest $request,
        string $id,
        QuizService $quizService
    ) {
        $item = Quiz::findOrFail($id);

        $data = $request->validated();

        $quizService->update($item, $data);

        return redirect(route('admin.quizzes.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Quiz::findOrFail($id);

        $item->delete();

        return back();
    }
}
