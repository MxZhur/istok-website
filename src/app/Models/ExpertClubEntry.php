<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertClubEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
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
        static::deleting(function ($entry) {
            // Delete the stored files
            foreach ($entry->storage_files as $storageFile) {
                $storageFile->delete();
            }

            Comment::root()
                ->byEntity(Comment::ENTITY_EXPERT_CLUB, $entry->id)
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
}
