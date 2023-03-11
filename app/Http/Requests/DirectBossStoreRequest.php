<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DirectBossStoreRequest extends FormRequest
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
            'email' => ['required', 'unique:direct_bosses,email', 'email'],
            'employee_number' => [
                'required',
                'unique:direct_bosses,employee_number',
                'max:255',
            ],
            'phone' => ['nullable', 'max:255', 'string'],
            'position_id' => ['required', 'exists:positions,id'],
        ];
    }
}
