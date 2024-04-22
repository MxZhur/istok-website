<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningMaterialStorageFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'learning_material_id',
        'storage_file_id',
    ];
}
