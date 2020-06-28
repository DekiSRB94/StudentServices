<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentStore extends FormRequest
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
            'name' => 'required|alpha|min:2|max:15',
            'surname' => 'required|alpha|min:2|max:20',
            'identification_number' => 'required|numeric|digits:13|unique:students,identification_number,' . $this->student,
            'index_number' => 'required|numeric|digits:10|beginswith20|unique:students,index_number,' . $this->student,
            'address' => 'required|string|min:5|max:40',
            'phone_number' => 'required|string|min:9|max:20|unique:students,phone_number,' . $this->student,
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|email|unique:students,email,' . $this->student, 
        ];
    }
}
