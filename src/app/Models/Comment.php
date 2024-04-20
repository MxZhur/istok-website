<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public const ENTITY_BLOG_POST = 'blog_post';

    protected $fillable = [
        'entity_type',
        'entity_id',
        'parent_id',
        'user_id',
        'text',
        'is_blocked',
    ];


    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('children');
    }

    protected $with = ['user'];

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
            'is_blocked' => 'boolean',
        ];
    }


    public function scopeRoot(Builder $query): void
    {
        $query->whereNull('parent_id');
    }


    public function scopeByEntity(Builder $query, string $entity_type, int $entity_id): void
    {
        $query->where('entity_type', $entity_type)->where('entity_id', $entity_id);
    }
}
