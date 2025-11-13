<?php

namespace App\Http\Requests\Expense;

use Illuminate\Foundation\Http\FormRequest;

class CreateExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'expense_type_id' => 'expense type',
            'cost' => 'cost',
            'notes' => 'notes',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'expense_type_id.required' => 'The expense type is required.',
            'expense_type_id.exists' => 'The selected expense type is invalid.',
            'cost.required' => 'The cost is required.',
            'cost.numeric' => 'The cost must be a number.',
        ];
    }
}