<?php

namespace Modules\Employee\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $employee = $this->route('employee');

        return [
            'name' => 'sometimes|string|max:255',

            'email' => [
                'sometimes',
                'email',
                Rule::unique('employees')->ignore($employee),
            ],

            'phone' => [
                'sometimes',
                'string',
                Rule::unique('employees')->ignore($employee),
            ],

            'designation' => 'sometimes|in:Intern,Associate,Senior,Manager',
            'monthly_salary_package' => 'sometimes|numeric|min:0',
        ];
    }
}

