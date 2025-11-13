<?php

namespace App\Http\Requests\Color;

use Illuminate\Foundation\Http\FormRequest;


class CreateColorRequest extends FormRequest
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
     */
    public function rules(): array
    {
     return [
            'name' => ['required', 'string', 'max:255', 'unique:colors,name'],
            'code' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The color name is required.',
            'name.unique' => 'This color name already exists.',        
        ];
    }
}