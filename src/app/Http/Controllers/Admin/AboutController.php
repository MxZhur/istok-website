<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\About\UpdateRequest;
use App\Models\CustomPage;
use Inertia\Inertia;

class AboutController extends Controller
{
    public function edit()
    {
        $pageModel = CustomPage::firstOrCreate(
            ['key' => 'about'],
            [
                'title' => 'О себе',
                'body' => '',
            ]
        );

        return Inertia::render('Admin/About/Edit', [
            'pageModel' => $pageModel,
        ]);
    }


    public function update(UpdateRequest $request)
    {
        $data = $request->validated();

        CustomPage::updateOrCreate(
            ['key' => 'about'],
            [
                'title' => 'О себе',
                'body' => $data['body'],
            ]
        );

        return back();
    }
}
