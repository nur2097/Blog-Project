<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->blogs;

        return [
            'image' => ['nullable', 'image'],
            'title' => ['required', 'max:200'],
            'category' => ['required'],
            'description' => ['required'],
            'seo_title' => ['max:200'],
            'seo_description' => ['max:200'],
            'status' => ['required', 'boolean']
        ];
    }
}
