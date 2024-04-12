<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BlogPostTag extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'blog_post_id',
        'tag_id',
    ];
}
