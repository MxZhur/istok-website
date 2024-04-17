<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class StorageFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'url',
        'original_name',
        'type',
    ];

    public static function booted()
    {
        static::deleting(function ($storageFile) {
            // Delete the actual file

            if (Storage::exists($storageFile->path)) {
                Storage::delete($storageFile->path);
            }
        });
    }
}
