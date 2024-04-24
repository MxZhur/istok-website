<?php

namespace App\Observers;

use App\Enums\ChangeLogActionType;
use App\Enums\ChangeLogSection;
use App\Models\ChangeLogEntry;
use App\Models\TeachingMaterial;

class TeachingMaterialObserver
{
    /**
     * Handle the TeachingMaterial "created" event.
     */
    public function created(TeachingMaterial $teachingMaterial): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::TEACHING_MATERIALS,
            'action_type' => ChangeLogActionType::TEACHING_MATERIAL_CREATED,
            'link_name' => $teachingMaterial->title,
            'link_url' => route('teaching_material.show', [
                'type' => $teachingMaterial->type,
                'id' => $teachingMaterial->id,
            ], false),
        ]);
    }

    /**
     * Handle the TeachingMaterial "updated" event.
     */
    public function updated(TeachingMaterial $teachingMaterial): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::TEACHING_MATERIALS,
            'action_type' => ChangeLogActionType::TEACHING_MATERIAL_UPDATED,
            'link_name' => $teachingMaterial->title,
            'link_url' => route('teaching_material.show', [
                'type' => $teachingMaterial->type,
                'id' => $teachingMaterial->id,
            ], false),
        ]);
    }

    /**
     * Handle the TeachingMaterial "deleted" event.
     */
    public function deleted(TeachingMaterial $teachingMaterial): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::TEACHING_MATERIALS,
            'action_type' => ChangeLogActionType::TEACHING_MATERIAL_DELETED,
            'link_name' => $teachingMaterial->title,
        ]);
    }

    /**
     * Handle the TeachingMaterial "restored" event.
     */
    public function restored(TeachingMaterial $teachingMaterial): void
    {
        //
    }

    /**
     * Handle the TeachingMaterial "force deleted" event.
     */
    public function forceDeleted(TeachingMaterial $teachingMaterial): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::TEACHING_MATERIALS,
            'action_type' => ChangeLogActionType::TEACHING_MATERIAL_DELETED,
            'link_name' => $teachingMaterial->title,
        ]);
    }
}
