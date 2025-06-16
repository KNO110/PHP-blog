<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id'    => ['sometimes', 'ulid', 'exists:users,id'],
            'slug'       => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('posts', 'slug')->ignore($this->post),
            ],
            'title'      => ['sometimes', 'string', 'max:128'],
            'content'    => ['sometimes', 'string'],
            'is_publish' => ['sometimes', 'boolean'],
            'image'      => ['nullable', 'string', 'max:2048'],
            'tags'       => ['sometimes', 'array'],
            'tags.*'     => ['ulid', 'exists:tags,id'],
        ];
    }
}
