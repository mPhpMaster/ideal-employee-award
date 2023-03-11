<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationUpdateRequest extends FormRequest
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
            'direct_boss_id' => ['required', 'exists:direct_bosses,id'],
            'employee_id' => ['required', 'exists:employees,id'],
            'supervisor_committee_id' => [
                'required',
                'exists:supervisor_committees,id',
            ],
            'technical_committee_id' => [
                'required',
                'exists:technical_committees,id',
            ],
            'award_id' => ['required', 'exists:awards,id'],
            'rank' => ['nullable', 'max:255'],
            'direct_boss_points' => ['nullable', 'max:255'],
            'supervisor_committee_points' => ['nullable', 'max:255'],
            'technical_committee_points' => ['nullable', 'max:255'],
            'employee_points' => ['nullable', 'max:255'],
        ];
    }
}
