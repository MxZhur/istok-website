<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeedbackEntry;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $itemsQuery = FeedbackEntry::query();

        if (!empty($q)) {
            $itemsQuery->where('text', 'LIKE', '%' . trim($q) . '%', 'or');
        }

        $itemsQuery->orderByDesc('created_at');

        /**@var LengthAwarePaginator */
        $paginate = $itemsQuery->paginate(20);

        $items = $paginate->withQueryString();

        return Inertia::render('Admin/Feedback/Index', [
            'items' => $items
        ]);
    }
}
