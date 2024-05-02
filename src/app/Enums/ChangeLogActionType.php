<?php

namespace App\Enums;

enum ChangeLogActionType: string
{
    case BLOG_CREATED = 'blog_created';
    case BLOG_UPDATED = 'blog_updated';
    case BLOG_DELETED = 'blog_deleted';

    case LEARNING_MATERIAL_CREATED = 'learning_material_created';
    case LEARNING_MATERIAL_UPDATED = 'learning_material_updated';
    case LEARNING_MATERIAL_DELETED = 'learning_material_deleted';
    
    case TEACHING_MATERIAL_CREATED = 'teaching_material_created';
    case TEACHING_MATERIAL_UPDATED = 'teaching_material_updated';
    case TEACHING_MATERIAL_DELETED = 'teaching_material_deleted';
    
    case EXPERT_CLUB_ENTRY_CREATED = 'expert_club_entry_created';
    case EXPERT_CLUB_ENTRY_UPDATED = 'expert_club_entry_updated';
    case EXPERT_CLUB_ENTRY_DELETED = 'expert_club_entry_deleted';
}
