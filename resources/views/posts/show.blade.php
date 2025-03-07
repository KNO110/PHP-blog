<x-layout title="{{ $post->title }}">
    <div class="container">
        <h1 class="title">{{ $post->title }}</h1>
        <p class="subtitle">Автор: {{ $post->author->name ?? 'Невідомий' }}</p>
        @if($post->image)
            <figure class="image">
                <img src="{{ $post->image }}" alt="{{ $post->title }}">
            </figure>
        @endif
        <div class="content">
            <p>{{ $post->content }}</p>
        </div>
        <p>Статус: {{ $post->is_publish ? 'Опубліковано' : 'Чернетка' }}</p>
        @if($post->tags->count())
            <div class="tags">
                @foreach($post->tags as $tag)
                    <span class="tag">{{ $tag->name }}</span>
                @endforeach
            </div>
        @endif
        <p>Коментарі: {{ $post->comments->count() }}</p>
        <p>Лайки: {{ $post->likes->count() }}</p>
        <div class="mt-4">
            <a href="{{ route('posts.edit', $post) }}" class="button is-info">Редагувати</a>
            <a href="{{ route('posts.index') }}" class="button is-light">Назад</a>
        </div>
    </div>
</x-layout>
