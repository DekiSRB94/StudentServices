<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectStore extends FormRequest
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
            'name' => 'required|string|min:3|max:20|unique:subjects,name,' . $this->subject,  
            'year' => ['required','regex:/^(I|II|III|IV)$/i'],
            'ects' => 'required|numeric|min:4|max:8',
            'semester' => 'required|numeric|min:1|max:2',
            'direction' => 'required|string|min:3|max:20',
        ];
    }
}
