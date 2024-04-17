<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'is_pinned',
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
        static::deleting(function ($blogPost) {
            // Delete the stored files
            foreach ($blogPost->storage_files as $storageFile) {
                $storageFile->delete();
            }
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
            'created_at' => 'datetime:d.m.Y H\:i',
            'updated_at' => 'datetime:d.m.Y H\:i',
            'is_pinned' => 'boolean',
        ];
    }
}
