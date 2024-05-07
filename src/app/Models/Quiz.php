<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    const TYPE_GRADE_9 = 'grade_9';
    const TYPE_GRADE_11 = 'grade_11';

    protected $fillable = [
        'type',
        'title',
        'questions',
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
            'questions' => 'array',
        ];
    }

    public function scopeByType(Builder $query, string $type): void
    {
        $query->where('type', $type);
    }
}
