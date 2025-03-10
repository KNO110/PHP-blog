<?php

namespace App\Providers;

use App\Events\PostPublished;
use App\Listeners\SendPostPublishedNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected array $listen = [
        PostPublished::class => [
            SendPostPublishedNotification::class,
        ],
    ];

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Model::unguard();

        Event::listen(function (PostPublished $event) {
            logger()->error($event->post->title.' ERROR FROM AppServiceProvider post published and send to user email:'.$event->email);
        });
    }
}
