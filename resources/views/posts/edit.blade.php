<x-layout title="Редагувати пост">
    <div class="container">
        <h1 class="title">Редагувати пост</h1>

        <form method="POST" action="{{ route('posts.update', $post) }}">
            @csrf
            @method('PUT')

            <div class="field">
                <label class="label">ID Користувача</label>
                <div class="control">
                    <input class="input @error('user_id') is-danger @enderror"
                           type="text"
                           name="user_id"
                           value="{{ old('user_id', $post->user_id) }}">
                </div>
                @error('user_id')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label class="label">Заголовок</label>
                <div class="control">
                    <input class="input @error('title') is-danger @enderror"
                           type="text"
                           name="title"
                           value="{{ old('title', $post->title) }}">
                </div>
                @error('title')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label class="label">Текст</label>
                <div class="control">
                    <textarea class="textarea @error('content') is-danger @enderror"
                              name="content">{{ old('content', $post->content) }}</textarea>
                </div>
                @error('content')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label class="label">URL зображення</label>
                <div class="control">
                    <input class="input @error('image') is-danger @enderror"
                           type="url"
                           name="image"
                           value="{{ old('image', $post->image) }}">
                </div>
                @error('image')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <div class="control">
                    <label class="checkbox">
                        <input type="checkbox" name="is_publish"
                               value="1" {{ old('is_publish', $post->is_publish) ? 'checked' : '' }}>
                        Опублікувати
                    </label>
                </div>
                @error('is_publish')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label class="label">Теги (ULIDs)</label>
                <div class="control">
                    <input class="input @error('tags') is-danger @enderror"
                           type="text"
                           name="tags[]"
                           value="{{ old('tags', $post->tags->pluck('id')->implode(',')) }}"
                           placeholder="Введіть ULIDs тегів через кому">
                </div>
                @error('tags')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-primary">Оновити</button>
                    <a href="{{ route('posts.index') }}" class="button is-light">Скасувати</a>
                </div>
            </div>
        </form>
    </div>
</x-layout>
