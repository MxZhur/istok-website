<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertClubEntryTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'expert_club_entry_id',
        'tag_id',
    ];
}
