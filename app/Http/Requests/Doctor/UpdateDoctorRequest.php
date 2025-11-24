<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Adjust as needed (for example, only admins can update)
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Assuming route-model binding: /doctors/{doctor}
        // So $this->doctor will hold the current model
        return [
            'name' => 'sometimes|required|string|max:255',

            'email' => [
                'sometimes',
                'required',
                'email',
                Rule::unique('doctors', 'email')->ignore($this->doctor),
            ],
            'phone' => [
                'sometimes',
                'required',
                'string',
                'max:20',
                Rule::unique('doctors', 'phone')->ignore($this->doctor),
            ],
            'whatsapp' => [
                'sometimes',
                'required',
                'string',
                'max:20',
                Rule::unique('doctors', 'whatsapp')->ignore($this->doctor),
            ],
            'address' => 'nullable|string|max:500',
        ];
    }

    /**
     * Custom error messages (optional)
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Doctor name is required when provided.',
            'email.required' => 'Email is required when provided.',
            'email.unique' => 'This email is already in use by another doctor.',
            'phone.required' => 'Phone number is required when provided.',
            'phone.unique' => 'This phone number is already in use by another doctor.',
        ];
    }
}
