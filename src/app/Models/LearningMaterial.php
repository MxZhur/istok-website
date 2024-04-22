<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'grade',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function storage_files()
    {
        return $this->belongsToMany(StorageFile::class);
    }

    protected $with = ['tags', 'storage_files'];

    public static function booted()
    {
        static::deleting(function ($material) {
            // Delete the stored files
            foreach ($material->storage_files as $storageFile) {
                $storageFile->delete();
            }

            Comment::root()
                ->byEntity(Comment::ENTITY_LEARNING_MATERIAL, $material->id)
                ->delete();
        });
    }

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
            'grade' => 'integer',
        ];
    }

    public function scopeByGrade(Builder $query, int $grade): void
    {
        $query->where('grade', $grade);
    }
}
