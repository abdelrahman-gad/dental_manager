<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'doctor_id' => 'required|exists:doctors,id',
            'color_id' => 'required|exists:colors,id',
            'tooth_type_id' => 'required|exists:tooth_types,id',
            'patient_name' => 'required|string|max:255',

            // Attachment (optional)
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

            // Units (array of IDs)
            'unit_types_ids' => 'required|array|min:1',
            'unit_types_ids.*' => 'exists:unit_types,id',

            // Discount info (optional)
            'discount_type' => 'nullable|in:PERCENTAGE,FIXED',
            'discount_value' => 'nullable|numeric|min:0',
        ];
    }

    /**
     * Custom error messages (optional)
     */
    public function messages(): array
    {
        return [
            'doctor_id.required' => 'Doctor is required.',
            'color_id.required' => 'Color is required.',
            'tooth_type_id.required' => 'Tooth type is required.',
            'patient_name.required' => 'Patient name is required.',
            'unit_types_ids.required' => 'At least one unit type is required.',
        ];
    }
}
