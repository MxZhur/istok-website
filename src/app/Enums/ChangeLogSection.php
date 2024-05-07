<?php

namespace App\Enums;

enum ChangeLogSection: string
{
    case BLOG = 'blog';
    case LEARNING_MATERIALS = 'learning_materials';
    case TEACHING_MATERIALS = 'teaching_materials';
    case EXPERT_CLUB = 'expert_club';
    case MINI_GAMES = 'mini_games';
    case QUIZZES = 'quizzes';
}
