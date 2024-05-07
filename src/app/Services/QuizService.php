<?php

namespace App\Services;

use App\Models\Quiz;

class QuizService
{
    public function store(array $data) {
        Quiz::create($data);
    }

    public function update(Quiz $item, array $data) {
        $item->fill($data);
        $item->save();
    }
}
