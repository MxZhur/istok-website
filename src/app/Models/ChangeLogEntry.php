<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeLogEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'section',
        'action_type',
        'link_name',
        'link_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }


    public function scopeByYear(Builder $query, int $year): void
    {
        $query->where('year', $year);
    }
}
