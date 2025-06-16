<?php

namespace App\Http\Controllers\Api;

use App\Events\PostPublished;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use App\Notifications\NewPostNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Post::query();

        if ($search = $request->input('search')) {
            $query->where(fn($q) =>
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
            );
        }

        if (!is_null($request->input('published'))) {
            $query->where('is_publish', (bool)$request->input('published'));
        }

        if ($author = $request->input('author')) {
            $query->where('user_id', $author);
        }

        if ($sort = $request->input('sort')) {
            $dir   = str_starts_with($sort, '-') ? 'desc' : 'asc';
            $field = ltrim($sort, '-');
            if (in_array($field, ['title', 'created_at'])) {
                $query->orderBy($field, $dir);
            }
        }

        $query->with(['tags', 'author'])
              ->withCount(['comments', 'likes']);

        $posts = $query
            ->paginate(10)
            ->appends($request->query());

        return response()->json(PostResource::collection($posts));
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        $post = Post::create($request->except('tags'));

        if ($request->has('tags')) {
            $post->tags()->attach($request->input('tags'));
        }

        User::limit(2)->get()
            ->each(fn(User $u) => $u->notify(new NewPostNotification($post)));

        return response()->json(new PostResource($post->load('tags')), 201);
    }

    public function show(Post $post): JsonResponse
    {
        $post->load(['tags', 'author'])
             ->loadCount(['comments', 'likes']);

        return response()->json(new PostResource($post), 200);
    }

    public function update(UpdatePostRequest $request, Post $post): JsonResponse
    {
        $post->update($request->except('tags'));

        if ($request->has('tags')) {
            $post->tags()->sync($request->input('tags'));
        }

        return response()->json(new PostResource($post->load('tags')), 200);
    }

    public function publish(Request $request, Post $post): JsonResponse
    {
        $post->update(['is_publish' => true]);

        event(new PostPublished($post, "insider.smidt@gmail.com"));

        return response()->json(new PostResource($post->load('tags')), 200);
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->tags()->detach();
        $post->delete();

        return response()->json(null, 204);
    }
}
