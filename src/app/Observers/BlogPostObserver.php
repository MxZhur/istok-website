<?php

namespace App\Observers;

use App\Enums\ChangeLogActionType;
use App\Enums\ChangeLogSection;
use App\Models\BlogPost;
use App\Models\ChangeLogEntry;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class BlogPostObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the BlogPost "created" event.
     */
    public function created(BlogPost $blogPost): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::BLOG,
            'action_type' => ChangeLogActionType::BLOG_CREATED,
            'link_name' => $blogPost->title,
            'link_url' => route('blog.show', $blogPost->id, false),
        ]);
    }

    /**
     * Handle the BlogPost "updated" event.
     */
    public function updated(BlogPost $blogPost): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::BLOG,
            'action_type' => ChangeLogActionType::BLOG_UPDATED,
            'link_name' => $blogPost->title,
            'link_url' => route('blog.show', $blogPost->id, false),
        ]);
    }

    /**
     * Handle the BlogPost "deleted" event.
     */
    public function deleted(BlogPost $blogPost): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::BLOG,
            'action_type' => ChangeLogActionType::BLOG_DELETED,
            'link_name' => $blogPost->title,
        ]);
    }

    /**
     * Handle the BlogPost "restored" event.
     */
    public function restored(BlogPost $blogPost): void
    {
        //
    }

    /**
     * Handle the BlogPost "force deleted" event.
     */
    public function forceDeleted(BlogPost $blogPost): void
    {
        ChangeLogEntry::create([
            'year' => intval(date('Y')),
            'section' => ChangeLogSection::BLOG,
            'action_type' => ChangeLogActionType::BLOG_DELETED,
            'link_name' => $blogPost->title,
        ]);
    }
}
