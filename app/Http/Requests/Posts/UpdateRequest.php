<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        return [
            //
             'name' => 'required|string|max:255', // ✅ MUST HAVE THIS
        'category_id' => 'required|exists:categories,id',
        'tags' => 'required|array',
        'tags.*' => 'exists:tags,id',
        'description' => 'required|string',
        'status' => 'boolean',

        ];
    }
}
