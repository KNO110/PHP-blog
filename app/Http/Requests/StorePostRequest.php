<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id'    => ['required', 'ulid', 'exists:users,id'],
            'slug'       => ['required', 'string', 'max:255', 'unique:posts,slug'],
            'title'      => ['required', 'string', 'max:128'],
            'content'    => ['required', 'string'],
            'is_publish' => ['boolean'],
            'image'      => ['nullable', 'string', 'url', 'max:2048'],
            'tags'       => ['nullable', 'array'],
            'tags.*'     => ['ulid', 'exists:tags,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required'    => 'Поле user_id є обов’язковим.',
            'user_id.ulid'        => 'Поле user_id має бути дійсним ULID.',
            'user_id.exists'      => 'Користувача з таким user_id не знайдено.',

            'slug.required'       => 'Поле slug є обов’язковим.',
            'slug.string'         => 'Поле slug має бути рядком.',
            'slug.max'            => 'Поле slug не може перевищувати 255 символів.',
            'slug.unique'         => 'Такий slug уже зайнятий.',

            'title.required'      => 'Поле title є обов’язковим.',
            'title.string'        => 'Поле title має бути рядком.',
            'title.max'           => 'Поле title не може перевищувати 128 символів.',

            'content.required'    => 'Поле content є обов’язковим.',
            'content.string'      => 'Поле content має бути рядком.',

            'is_publish.boolean'  => 'Поле is_publish має бути true або false.',

            'image.string'        => 'Поле image має бути рядком.',
            'image.url'           => 'Поле image має бути дійсною URL-адресою.',
            'image.max'           => 'URL зображення не може перевищувати 2048 символів.',

            'tags.array'          => 'Поле tags має бути масивом.',
            'tags.*.ulid'         => 'Кожен тег має бути дійсним ULID.',
            'tags.*.exists'       => 'Один або більше тегів не знайдено.',
        ];
    }
}
