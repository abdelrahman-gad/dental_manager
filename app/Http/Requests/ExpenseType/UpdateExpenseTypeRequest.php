<?php

namespace App\Http\Requests\ExpenseType;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpenseTypeRequest extends FormRequest
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
        // try common route parameter names used for route-model binding
        $expenseTypeId = $this->route('expense_type') ?? $this->route('expenseType');

        if ($expenseTypeId instanceof \Illuminate\Database\Eloquent\Model) {
            $expenseTypeId = $expenseTypeId->getKey();
        }

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                \Illuminate\Validation\Rule::unique('expense_types', 'name')->ignore($expenseTypeId),
            ],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The expense type name is required.',
            'name.unique' => 'This expense type name already exists.',
        ];
    }
}