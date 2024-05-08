<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    const ENTITY_BLOG = 'blog';
    const ENTITY_LEARNING_MATERIAL = 'learning_material';
    const ENTITY_TEACHING_MATERIAL = 'teaching_material';
    const ENTITY_EXPERT_CLUB = 'expert_club';

    protected $fillable = [
        'name'
    ];

    public function posts()
    {
        return $this->belongsToMany(BlogPost::class);
    }

    public function scopeByEntityType(Builder $query, string $entityType): void
    {
        switch ($entityType) {
            case static::ENTITY_BLOG:
                $entityTable = 'blog_post_tag';
                break;
            case static::ENTITY_LEARNING_MATERIAL:
                $entityTable = 'learning_material_tag';
                break;
            case static::ENTITY_TEACHING_MATERIAL:
                $entityTable = 'tag_teaching_material';
                break;
            case static::ENTITY_EXPERT_CLUB:
                $entityTable = 'expert_club_entry_tag';
                break;

            default:
                return;
        }

        $query->whereIn('id', function ($subQuery) use ($entityTable) {
            $subQuery->select('tag_id')
                ->distinct()
                ->from($entityTable);
        });
    }
}
