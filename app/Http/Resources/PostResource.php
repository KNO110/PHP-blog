<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @template T of Post
 * @extends JsonResource<T>
 */
class PostResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Post $this */
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'content' => $this->content,
            'is_publish' => (bool) $this->is_publish,
            'image' => $this->image,
            'author' => [
                'id' => $this->author?->id,
                'name' => $this->author?->name,
            ],
            'tags' => $this->tags->map(fn($tag) => [
                'id' => $tag->id,
                'name' => $tag->name,
            ]),
            'comments_count' => $this->comments_count,
            'likes_count' => $this->likes_count,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
