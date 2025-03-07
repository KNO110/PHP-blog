@props(['post'])

<div class="column is-one-third">
    <div class="card">
        <div class="card-content">
            <p class="title is-4">
                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
            </p>
            <p class="subtitle is-6">{{ Str::limit($post->content, 100) }}</p>
            <p class="is-size-7">Автор: {{ $post->author->name ?? 'Невідомий' }}</p>
            @if($post->tags->count())
                <div class="tags">
                    @foreach($post->tags as $tag)
                        <span class="tag">{{ $tag->name }}</span>
                    @endforeach
                </div>
            @endif
        </div>
        <footer class="card-footer">
            <a href="{{ route('posts.edit', $post) }}" class="card-footer-item">Редагувати</a>
            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="card-footer-item">
                @csrf
                @method('DELETE')
                <button type="submit" class="button is-text has-text-danger"
                        onclick="return confirm('Ви впевнені?')">Видалити
                </button>
            </form>
        </footer>
    </div>
</div>
