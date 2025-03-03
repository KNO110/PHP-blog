<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::factory(5)->create()->each(function (Post $post) {
            $tags = Tag::all();
            $randomTags = $tags->random(3)->pluck('id')->toArray();
            $post->tags()->attach($randomTags);
        });
    }
}
