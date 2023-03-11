<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SupervisorCommitteeUpdateRequest extends FormRequest
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
            'email' => [
                'required',
                Rule::unique('supervisor_committees', 'email')->ignore(
                    $this->supervisorCommittee
                ),
                'email',
            ],
            'employee_number' => [
                'required',
                Rule::unique(
                    'supervisor_committees',
                    'employee_number'
                )->ignore($this->supervisorCommittee),
                'max:255',
            ],
            'phone' => ['nullable', 'max:255', 'string'],
        ];
    }
}
