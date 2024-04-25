<?php

namespace App\Http\Controllers;

use App\Models\CustomPage;
use Inertia\Inertia;

class AboutController extends Controller
{
    public function index()
    {
        $pageModel = CustomPage::firstOrCreate(
            ['key' => 'about'],
            [
                'title' => 'О себе',
                'body' => '',
            ]
        );

        return Inertia::render('About/Index', [
            'pageModel' => $pageModel,
        ]);
    }
}
