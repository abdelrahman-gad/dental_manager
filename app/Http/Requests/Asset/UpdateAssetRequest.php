<?php

namespace App\Http\Requests\Asset;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAssetRequest extends FormRequest
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
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('assets', 'name')->ignore($this->asset->id),
            ],
            'cost' => 'sometimes|required|numeric|min:0',
            'notes' => 'sometimes|required|string|max:255',
        ];
    }

    /**
     * Custom error messages (optional)
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The asset name is required.',
            'name.unique' => 'An asset with this name already exists.',
            'cost.required' => 'The cost of the asset is required.',
            'cost.numeric' => 'The cost must be a numeric value.',
            'cost.min' => 'The cost must be at least 0.',
            'notes.max' => 'Notes cannot exceed 255 characters.',
        ];
    }
}
