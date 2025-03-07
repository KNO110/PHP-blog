<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::with(['author', 'tags'])
            ->latest()
            ->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        $post = new Post();
        $post->user_id = $validated['user_id'];
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->slug = $validated['slug'] ?? Str::slug($validated['title']);
        $post->is_publish = $validated['is_publish'] ?? false;
        $post->image = $validated['image'] ?? null;
        $post->save();

        if (isset($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        }

        return redirect()
            ->route('posts.index')
            ->with('success', 'Пост успішно створено!');
    }

    public function show(Post $post): View
    {
        $post->load(['author', 'tags', 'comments', 'likes']);
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post): View
    {
        $post->load('tags');
        return view('posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $validated = $request->validated();

        $post->update([
            'user_id' => $validated['user_id'] ?? $post->user_id,
            'title' => $validated['title'] ?? $post->title,
            'content' => $validated['content'] ?? $post->content,
            'slug' => $validated['slug'] ?? Str::slug($validated['title'] ?? $post->title),
            'is_publish' => $validated['is_publish'] ?? $post->is_publish,
            'image' => $validated['image'] ?? $post->image,
        ]);

        if (isset($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        }

        return redirect()
            ->route('posts.index')
            ->with('success', 'Пост успішно оновлено!');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->tags()->detach(); // Видаляємо зв’язки з тегами
        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Пост успішно видалено!');
    }
}
