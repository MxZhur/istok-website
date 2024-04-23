<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingMaterial extends Model
{
    use HasFactory;

    public const TYPE_METHODOLOGICAL_WORK = 'methodological_work'; // "Методическая работа"
    public const TYPE_EDUCATIONAL_WORK = 'educational_work'; // "Воспитательная работа"

    protected $fillable = [
        'title',
        'body',
        'type',
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
                ->byEntity(Comment::ENTITY_TEACHING_MATERIAL, $material->id)
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
        ];
    }

    public function scopeByType(Builder $query, string $type): void
    {
        $query->where('type', $type);
    }
}
