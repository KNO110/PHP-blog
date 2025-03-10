<?php

namespace App\Listeners;

use App\Events\PostPublished;
use Illuminate\Support\Facades\Mail;

class SendPostPublishedNotification
{
    public function handle(PostPublished $event): void
    {
        Mail::to($event->email)->send(new \App\Mail\PostPublished(
            "New post published on my website ".config('app.name')." Title: {$event->post->title}",
        ));
    }
}
