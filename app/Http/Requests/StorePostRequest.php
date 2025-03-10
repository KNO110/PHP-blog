<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|ulid|exists:users,id', // Перевірка, що user_id існує в таблиці users
            'slug' => 'sometimes|string|max:255|unique:posts,slug', // Унікальний slug
            'title' => 'required|string|max:128', // Максимум 128 символів
            'content' => 'required|string', // Текст без обмеження довжини
            'is_publish' => 'boolean', // Лише true/false
            'image' => 'nullable|string|url|max:2048', // Максимум 2048 символів, необов’язкове
            'tags' => 'nullable|array', // Теги необов’язкові
            'tags.*' => 'ulid|exists:tags,id', // Кожен тег має існувати в таблиці tags
        ];
    }

    public function messages(): array
    {
        return [
            // Повідомлення для 'user_id'
            'user_id.required' => 'Поле user_id є обов’язковим для заповнення.',
            'user_id.ulid' => 'Поле user_id має бути дійсним ULID.',
            'user_id.exists' => 'Користувача з таким user_id не знайдено.',

            // Повідомлення для 'slug'
            'slug.sometimes' => 'Поле slug має бути присутнім, якщо вказано.',
            'slug.string' => 'Поле slug має бути рядком.',
            'slug.max' => 'Поле slug не може перевищувати 255 символів.',
            'slug.unique' => 'Такий slug уже зайнятий, виберіть інший.',

            // Повідомлення для 'title'
            'title.required' => 'Заголовок є обов’язковим для заповнення.',
            'title.string' => 'Заголовок має бути рядком.',
            'title.max' => 'Заголовок не може перевищувати 128 символів.',

            // Повідомлення для 'content'
            'content.required' => 'Вміст є обов’язковим для заповнення.',
            'content.string' => 'Вміст має бути рядком.',

            // Повідомлення для 'is_publish'
            'is_publish.boolean' => 'Поле is_publish має бути true або false.',

            // Повідомлення для 'image'
            'image.nullable' => 'Поле image може бути порожнім.',
            'image.string' => 'Поле image має бути рядком.',
            'image.url' => 'Поле image має бути дійсною URL-адресою.',
            'image.max' => 'URL зображення не може перевищувати 2048 символів.',

            // Повідомлення для 'tags'
            'tags.nullable' => 'Поле tags може бути порожнім.',
            'tags.array' => 'Поле tags має бути масивом.',

            // Повідомлення для 'tags.*'
            'tags.*.ulid' => 'Кожен тег має бути дійсним ULID.',
            'tags.*.exists' => 'Один або більше тегів не знайдено в базі даних.',
        ];
    }
}
