<?php

namespace App\Observers;

use App\Enums\ChangeLogActionType;
use App\Enums\ChangeLogSection;
use App\Models\ChangeLogEntry;
use App\Models\LearningMaterial;

class LearningMaterialObserver
{
    /**
     * Handle the LearningMaterial "created" event.
     */
    public function created(LearningMaterial $learningMaterial): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::LEARNING_MATERIALS,
            'action_type' => ChangeLogActionType::LEARNING_MATERIAL_CREATED,
            'link_name' => $learningMaterial->title,
            'link_url' => route('learning_material.show', [
                'grade' => $learningMaterial->grade,
                'id' => $learningMaterial->id,
            ], false),
        ]);
    }

    /**
     * Handle the LearningMaterial "updated" event.
     */
    public function updated(LearningMaterial $learningMaterial): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::LEARNING_MATERIALS,
            'action_type' => ChangeLogActionType::LEARNING_MATERIAL_UPDATED,
            'link_name' => $learningMaterial->title,
            'link_url' => route('learning_material.show', [
                'grade' => $learningMaterial->grade,
                'id' => $learningMaterial->id,
            ], false),
        ]);
    }

    /**
     * Handle the LearningMaterial "deleted" event.
     */
    public function deleted(LearningMaterial $learningMaterial): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::LEARNING_MATERIALS,
            'action_type' => ChangeLogActionType::LEARNING_MATERIAL_DELETED,
            'link_name' => $learningMaterial->title,
        ]);
    }

    /**
     * Handle the LearningMaterial "restored" event.
     */
    public function restored(LearningMaterial $learningMaterial): void
    {
        //
    }

    /**
     * Handle the LearningMaterial "force deleted" event.
     */
    public function forceDeleted(LearningMaterial $learningMaterial): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::LEARNING_MATERIALS,
            'action_type' => ChangeLogActionType::LEARNING_MATERIAL_DELETED,
            'link_name' => $learningMaterial->title,
        ]);
    }
}
