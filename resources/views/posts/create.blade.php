<x-layout title="Створити пост">
    <div class="container">
        <h1 class="title">Новий пост</h1>

        @if ($errors->any())
            <div class="notification is-danger">
                <h2 class="subtitle">Помилки валідації:</h2>
                <pre>
                    {{ print_r($errors->all(), true) }}
                </pre>
                <h3>Усі дані з форми:</h3>
                <pre>
                    {{ print_r(old(), true) }}
                </pre>
            </div>
        @endif

        <form method="POST" action="{{ route('posts.store') }}">
            @csrf

            <div class="field">
                <label class="label">ID Користувача</label>
                <div class="control">
                    <input class="input @error('user_id') is-danger @enderror"
                           type="text"
                           name="user_id"
                           value="{{ old('user_id') }}">
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
                           value="{{ old('title') }}">
                </div>
                @error('title')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label class="label">Текст</label>
                <div class="control">
                    <textarea class="textarea @error('content') is-danger @enderror"
                              name="content">{{ old('content') }}</textarea>
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
                           value="{{ old('image') }}">
                </div>
                @error('image')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <div class="control">
                    <label class="checkbox">
                        <input type="checkbox" name="is_publish" value="1" {{ old('is_publish') ? 'checked' : '' }}>
                        Опублікувати
                    </label>
                </div>
                @error('is_publish')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Примітка: Поле tags потребує списку тегів, додайте його відповідно до вашої реалізації -->
            <div class="field">
                <label class="label">Теги (ULIDs)</label>
                <div class="control">
                    <input class="input @error('tags') is-danger @enderror"
                           type="text"
                           name="tags[]"
                           value="{{ old('tags') ? implode(',', old('tags')) : '' }}"
                           placeholder="Введіть ULIDs тегів через кому">
                </div>
                @error('tags')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-primary">Створити</button>
                    <a href="{{ route('posts.index') }}" class="button is-light">Скасувати</a>
                </div>
            </div>
        </form>
    </div>
</x-layout>
