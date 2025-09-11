<?php

namespace Modules\Employee\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // අපි දැනට හැම request එකකටම අවසර දෙනවා.
        // Authentication එකතු කළ පසු මෙතන වෙනස් කළ හැක.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // PDF එකට අදාළ validation rules ටික මෙතනට දාමු
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|string|unique:employees,phone',
            'designation' => 'required|in:Intern,Associate,Senior,Manager',
            'monthly_salary_package' => 'required|numeric|min:0',
        ];
    }
}
