<?php

namespace App\Observers;

use App\Enums\ChangeLogActionType;
use App\Enums\ChangeLogSection;
use App\Models\MiniGame;
use App\Models\ChangeLogEntry;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class MiniGameObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the MiniGame "created" event.
     */
    public function created(MiniGame $miniGame): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::MINI_GAMES,
            'action_type' => ChangeLogActionType::MINI_GAME_CREATED,
            'link_name' => $miniGame->title,
            'link_url' => route('mini_game.show', [
                'category' => $miniGame->category,
                'id' => $miniGame->id,
            ], false),
        ]);
    }

    /**
     * Handle the MiniGame "updated" event.
     */
    public function updated(MiniGame $miniGame): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::MINI_GAMES,
            'action_type' => ChangeLogActionType::MINI_GAME_UPDATED,
            'link_name' => $miniGame->title,
            'link_url' => route('mini_game.show', [
                'category' => $miniGame->category,
                'id' => $miniGame->id,
            ], false),
        ]);
    }

    /**
     * Handle the MiniGame "deleted" event.
     */
    public function deleted(MiniGame $miniGame): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::MINI_GAMES,
            'action_type' => ChangeLogActionType::MINI_GAME_DELETED,
            'link_name' => $miniGame->title,
        ]);
    }

    /**
     * Handle the MiniGame "restored" event.
     */
    public function restored(MiniGame $miniGame): void
    {
        //
    }

    /**
     * Handle the MiniGame "force deleted" event.
     */
    public function forceDeleted(MiniGame $miniGame): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::MINI_GAMES,
            'action_type' => ChangeLogActionType::MINI_GAME_DELETED,
            'link_name' => $miniGame->title,
        ]);
    }
}
