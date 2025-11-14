<?php

namespace App\Http\Requests\ToothType;

use Illuminate\Foundation\Http\FormRequest;

class CreateToothTypeRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:tooth_types,name'],
            'description' => ['nullable', 'string', 'max:1000'],
            'cost' => ['required', 'numeric', 'min:0'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The tooth type name is required.',
            'name.unique' => 'This tooth type name already exists.',
            'cost.required' => 'The cost is required.',
            'cost.numeric' => 'The cost must be a numeric value.',
            'cost.min' => 'The cost must be at least 0.',
        ];
    }
}