<?php

namespace Modules\Employee\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
{


    public function authorize(): bool
    {
        return true;
    }

    /**
     *
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|string|unique:employees,phone',
            'designation' => 'required|in:Intern,Associate,Senior,Manager',
            'monthly_salary_package' => 'required|numeric|min:0',
        ];
    }
}
