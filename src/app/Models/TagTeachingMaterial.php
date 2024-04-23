<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagTeachingMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'teaching_material_id',
        'tag_id',
    ];
}
