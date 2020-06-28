<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfessorStore extends FormRequest
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
            'identification_number' => 'required|numeric|digits:13|unique:professors,identification_number,' . $this->professor,
            'address' => 'required|string|min:5|max:40',
            'phone_number' => 'required|string|min:9|max:20|unique:professors,phone_number,' . $this->professor,
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|email|unique:professors,email,' . $this->professor, 
        ];
    }
}
