<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        // TODO: виправити те, що автор пустий :)
        $posts = Post::with('tags', 'author')
            ->withCount('comments', 'likes')
            ->latest()
            ->paginate(10);
        return response()->json(PostResource::collection($posts));
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        $post = Post::create($request->except('tags'));

        if ($request->has('tags')) {
            $post->tags()->attach($request->input('tags'));
        }

        return response()->json(new PostResource($post->load('tags')), 201);
    }

    public function show(Post $post): JsonResponse
    {
        // TODO: виправити те, що автор пустий :)
        $resource = $post->load('tags', 'author')->loadCount(['comments', 'likes']);
        return response()->json(new PostResource($resource), 200);
    }

    public function update(UpdatePostRequest $request, Post $post): JsonResponse
    {
        $post->update($request->except('tags'));

        if ($request->has('tags')) {
            $post->tags()->sync($request->input('tags'));
        }

        return response()->json(new PostResource($post->load('tags')), 200);
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->tags()->detach();
        $post->delete();

        return response()->json(null, 204);
    }
}
