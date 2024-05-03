<?php

namespace App\Services;

use App\Models\MiniGame;

class MiniGameService
{
    public function store(array $data) {
        MiniGame::create($data);
    }

    public function update(MiniGame $item, array $data) {
        $item->fill($data);
        $item->save();
    }
}
