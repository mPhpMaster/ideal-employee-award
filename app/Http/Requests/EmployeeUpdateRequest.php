<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255', 'string'],
            'phone' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email'],
            'employee_number' => [
                'required',
                Rule::unique('employees', 'employee_number')->ignore(
                    $this->employee
                ),
                'max:255',
            ],
            'position_id' => ['required', 'exists:positions,id'],
            'direct_boss_id' => ['required', 'exists:direct_bosses,id'],
        ];
    }
}
