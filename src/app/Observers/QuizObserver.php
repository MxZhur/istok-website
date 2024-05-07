<?php

namespace App\Observers;

use App\Enums\ChangeLogActionType;
use App\Enums\ChangeLogSection;
use App\Models\ChangeLogEntry;
use App\Models\Quiz;

class QuizObserver
{
    /**
     * Handle the Quiz "created" event.
     */
    public function created(Quiz $quiz): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::QUIZZES,
            'action_type' => ChangeLogActionType::QUIZ_CREATED,
            'link_name' => $quiz->title,
            'link_url' => route('quiz.show', [
                'type' => $quiz->type,
                'id' => $quiz->id,
            ], false),
        ]);
    }

    /**
     * Handle the Quiz "updated" event.
     */
    public function updated(Quiz $quiz): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::QUIZZES,
            'action_type' => ChangeLogActionType::QUIZ_UPDATED,
            'link_name' => $quiz->title,
            'link_url' => route('quiz.show', [
                'type' => $quiz->type,
                'id' => $quiz->id,
            ], false),
        ]);
    }

    /**
     * Handle the Quiz "deleted" event.
     */
    public function deleted(Quiz $quiz): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::QUIZZES,
            'action_type' => ChangeLogActionType::QUIZ_DELETED,
            'link_name' => $quiz->title,
        ]);
    }

    /**
     * Handle the Quiz "restored" event.
     */
    public function restored(Quiz $quiz): void
    {
        //
    }

    /**
     * Handle the Quiz "force deleted" event.
     */
    public function forceDeleted(Quiz $quiz): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::QUIZZES,
            'action_type' => ChangeLogActionType::QUIZ_DELETED,
            'link_name' => $quiz->title,
        ]);
    }
}
