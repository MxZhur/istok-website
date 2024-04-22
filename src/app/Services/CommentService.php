<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    public function getCommentsTree(string $entityType, int $entityId)
    {
        return Comment::root()
            ->byEntity($entityType, $entityId)
            ->orderByDesc('created_at')
            ->with('children')
            ->get();
    }
}
