<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|ulid|exists:users,id',
            'slug' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('posts', 'slug')->ignore($this->post), // Унікальність, ігноруючи поточний пост
            ],
            'title' => 'sometimes|string|max:128',
            'content' => 'sometimes|string',
            'is_publish' => 'sometimes|boolean',
            'image' => 'nullable|string|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'ulid|exists:tags,id',
        ];
    }
}
