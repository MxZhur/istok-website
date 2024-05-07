<?php

namespace App\Providers;

use App\Models\BlogPost;
use App\Models\ExpertClubEntry;
use App\Models\LearningMaterial;
use App\Models\MiniGame;
use App\Models\Quiz;
use App\Models\TeachingMaterial;
use App\Observers\BlogPostObserver;
use App\Observers\LearningMaterialObserver;
use App\Observers\TeachingMaterialObserver;
use App\Observers\ExpertClubEntryObserver;
use App\Observers\MiniGameObserver;
use App\Observers\QuizObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        BlogPost::observe(BlogPostObserver::class);
        LearningMaterial::observe(LearningMaterialObserver::class);
        TeachingMaterial::observe(TeachingMaterialObserver::class);
        ExpertClubEntry::observe(ExpertClubEntryObserver::class);
        MiniGame::observe(MiniGameObserver::class);
        Quiz::observe(QuizObserver::class);
    }
}
