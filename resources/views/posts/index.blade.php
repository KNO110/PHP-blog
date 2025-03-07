<x-layout title="Список постів">
    <div class="container">
        <h1 class="title">Усі пости</h1>

        @if(session('success'))
            <x-alert type="success">{{ session('success') }}</x-alert>
        @endif

        <div class="mb-4">
            <a href="{{ route('posts.create') }}" class="button is-primary">Створити новий пост</a>
        </div>

        <div class="columns is-multiline">
            @forelse($posts as $post)
                <x-posts.card :post="$post"/>
            @empty
                <div class="column">
                    <p class="has-text-centered">Пости відсутні</p>
                </div>
            @endforelse
        </div>

        {{ $posts->links() }}
    </div>
</x-layout>
