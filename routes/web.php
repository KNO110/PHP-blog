<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;

Route::get('/', fn() => view('welcome'));

Route::prefix('api')->group(function(){
    Route::apiResource('posts', PostController::class);
});

Route::get('/test-create', function(){
    $data = [
        'user_id'    => '01jxwryvtt3mzd0zs8av0hfbfs', // <- замени на ULID
        'slug'       => 'test-post',
        'title'      => 'Тестовый заголовок',
        'content'    => 'Текст тестового поста',
        'is_publish' => false,
        'image'      => '',
        'tags'       => [],
    ];

    $formRequest = StorePostRequest::createFrom(Request::create(
        '/api/posts', 'POST', $data
    ));
    $formRequest->setContainer(app())
                ->setRedirector(app('redirect'))
                ->validateResolved();

    return app(PostController::class)->store($formRequest);
});

Route::get('/test-update', function(){
    $post = Post::where('slug','test-post')->firstOrFail();

    $data = [
        'title'      => 'Обновлённый заголовок',
        'is_publish' => true,
        'tags'       => [],
    ];

    $formRequest = UpdatePostRequest::createFrom(Request::create(
        '/api/posts/'.$post->slug, 'PUT', $data
    ));
    $formRequest->setContainer(app())
                ->setRedirector(app('redirect'))
                ->validateResolved();

    return app(PostController::class)
           ->update($formRequest, $post);
});
