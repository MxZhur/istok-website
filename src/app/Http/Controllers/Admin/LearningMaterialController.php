<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LearningMaterial\StoreRequest;
use App\Http\Requests\Admin\LearningMaterial\UpdateRequest;
use App\Models\LearningMaterial;
use App\Models\Tag;
use App\Services\LearningMaterialService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LearningMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->query('q');
        $grade = $request->query('grade');

        $itemsQuery = LearningMaterial::query();

        if (!empty($q)) {
            $itemsQuery->where('title', 'LIKE', '%' . trim($q) . '%', 'or');

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

        if (!empty($grade)) {
            $itemsQuery->byGrade(intval($grade));
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

        return Inertia::render('Admin/LearningMaterial/Index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/LearningMaterial/Create', [
            'availableTags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        StoreRequest $request,
        LearningMaterialService $learningMaterialService
    ) {
        $data = $request->validated();

        $learningMaterialService->store($data);

        return redirect(route('admin.learning_materials.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect(route('admin.learning_materials.edit', ['id' => $id]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = LearningMaterial::findOrFail($id);

        return Inertia::render('Admin/LearningMaterial/Edit', [
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
        LearningMaterialService $learningMaterialService
    ) {
        $item = LearningMaterial::findOrFail($id);

        $data = $request->validated();

        $learningMaterialService->update($item, $data);

        return redirect(route('admin.learning_materials.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = LearningMaterial::findOrFail($id);

        $item->delete();

        return back();
    }
}
