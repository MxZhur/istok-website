<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiniGame extends Model
{
    use HasFactory;

    const CATEROGY_WORLD_HISTORY = 'world_history';
    const CATEROGY_RUSSIA_9_13_CENTURY = 'russia_9_13_century';
    const CATEROGY_RUSSIA_14_17_CENTURY = 'russia_14_17_century';
    const CATEROGY_RUSSIA_18_19_CENTURY = 'russia_18_19_century';
    const CATEROGY_RUSSIA_20_CENTURY = 'russia_20_century';
    const CATEROGY_RUSSIA_21_CENTURY = 'russia_21_century';

    protected $fillable = [
        'category',
        'title',
        'body',
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

    public function scopeByCategory(Builder $query, string $category): void
    {
        $query->where('category', $category);
    }
}
