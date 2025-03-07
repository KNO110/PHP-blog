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
}
