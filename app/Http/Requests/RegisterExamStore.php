<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterExamStore extends FormRequest
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
            'subject_name' => 'required|string|min:3|max:20',
            'status' => ['regex:/^(Active|Failed|Passed)$/i'],
            'year' => 'required|digits:4|integer|min:'. (date('Y')) .'|max:'. (date('Y')),
        ];
    }
}
