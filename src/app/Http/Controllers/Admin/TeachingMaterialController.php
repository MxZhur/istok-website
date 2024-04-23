<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeachingMaterial\StoreRequest;
use App\Http\Requests\Admin\TeachingMaterial\UpdateRequest;
use App\Models\TeachingMaterial;
use App\Models\Tag;
use App\Services\TeachingMaterialService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeachingMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->query('q');
        $type = $request->query('type');

        $itemsQuery = TeachingMaterial::query();

        if (!empty($q)) {
            $itemsQuery->where('title', 'LIKE', '%' . trim($q) . '%', 'or');

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

        return Inertia::render('Admin/TeachingMaterial/Index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/TeachingMaterial/Create', [
            'availableTags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        StoreRequest $request,
        TeachingMaterialService $teachingMaterialService
    ) {
        $data = $request->validated();

        $teachingMaterialService->store($data);

        return redirect(route('admin.teaching_materials.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect(route('admin.teaching_materials.edit', ['id' => $id]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = TeachingMaterial::findOrFail($id);

        return Inertia::render('Admin/TeachingMaterial/Edit', [
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
        TeachingMaterialService $teachingMaterialService
    ) {
        $item = TeachingMaterial::findOrFail($id);

        $data = $request->validated();

        $teachingMaterialService->update($item, $data);

        return redirect(route('admin.teaching_materials.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = TeachingMaterial::findOrFail($id);

        $item->delete();

        return back();
    }
}
