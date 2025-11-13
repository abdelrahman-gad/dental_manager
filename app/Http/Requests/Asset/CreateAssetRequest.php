<?php

namespace App\Http\Requests\Asset;

use Illuminate\Foundation\Http\FormRequest;

class CreateAssetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Allow access; you can later restrict it to admins if needed.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:assets,name',
            'cost' => 'required|numeric|min:1',
            'notes' => 'nullable|string|max:255',
        ];
    }

    /**
     * Custom messages (optional).
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The asset name is required.',
            'name.unique' => 'An asset with this name already exists.',
            'cost.required' => 'The cost of the asset is required.',
            'cost.numeric' => 'The cost must be a numeric value.',
            'cost.min' => 'The cost must be at least 1.',
            'notes.max' => 'Notes cannot exceed 255 characters.',
        ];
    }
}
