<?php

namespace App\Http\Controllers;

use App\Models\ChangeLogEntry;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChangeLogController extends Controller
{
    public function index()
    {
        $yearsCollection = ChangeLogEntry::query()
            ->distinct()
            ->orderByDesc('year')
            ->get('year')
            ->toArray();
        
        $years = array_map(function ($year) {
            return $year['year'];
        }, $yearsCollection);

        return Inertia::render('ChangeLog/Index', [
            'years' => $years
        ]);
    }


    public function year(int $year)
    {
        $itemsQuery = ChangeLogEntry::query()
            ->byYear($year)
            ->orderByDesc('created_at');

        /**@var LengthAwarePaginator */
        $paginate = $itemsQuery->paginate(50);

        $items = $paginate->withQueryString();

        return Inertia::render('ChangeLog/Year', [
            'year' => $year,
            'items' => $items,
        ]);
    }
}
