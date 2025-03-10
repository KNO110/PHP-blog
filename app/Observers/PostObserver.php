<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    public function created(Post $post): void
    {
        logger()->info($post->title);
    }

    public function updated(Post $post): void
    {
        //
    }


    public function deleted(Post $post): void
    {
        logger()->warning($post->title);
    }

    public function restored(Post $post): void
    {
        //
    }

    public function forceDeleted(Post $post): void
    {
        //
    }
}
