<?php

namespace App\Observers;

use App\Enums\ChangeLogActionType;
use App\Enums\ChangeLogSection;
use App\Models\ExpertClubEntry;
use App\Models\ChangeLogEntry;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class ExpertClubEntryObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the ExpertClubEntry "created" event.
     */
    public function created(ExpertClubEntry $expertClubEntry): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::EXPERT_CLUB,
            'action_type' => ChangeLogActionType::EXPERT_CLUB_ENTRY_CREATED,
            'link_name' => $expertClubEntry->title,
            'link_url' => route('expert_club.show', $expertClubEntry->id, false),
        ]);
    }

    /**
     * Handle the ExpertClubEntry "updated" event.
     */
    public function updated(ExpertClubEntry $expertClubEntry): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::EXPERT_CLUB,
            'action_type' => ChangeLogActionType::EXPERT_CLUB_ENTRY_UPDATED,
            'link_name' => $expertClubEntry->title,
            'link_url' => route('expert_club.show', $expertClubEntry->id, false),
        ]);
    }

    /**
     * Handle the ExpertClubEntry "deleted" event.
     */
    public function deleted(ExpertClubEntry $expertClubEntry): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::EXPERT_CLUB,
            'action_type' => ChangeLogActionType::EXPERT_CLUB_ENTRY_DELETED,
            'link_name' => $expertClubEntry->title,
        ]);
    }

    /**
     * Handle the ExpertClubEntry "restored" event.
     */
    public function restored(ExpertClubEntry $expertClubEntry): void
    {
        //
    }

    /**
     * Handle the ExpertClubEntry "force deleted" event.
     */
    public function forceDeleted(ExpertClubEntry $expertClubEntry): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::EXPERT_CLUB,
            'action_type' => ChangeLogActionType::EXPERT_CLUB_ENTRY_DELETED,
            'link_name' => $expertClubEntry->title,
        ]);
    }
}
