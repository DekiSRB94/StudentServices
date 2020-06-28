<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamOptionStore extends FormRequest
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
            'examination_period' => ['required','regex:/^(none|January|February|March|April|May|June|July|August|September|October|November|December)$/i'],
            'status' => ['required','regex:/^(Inactive|Active)$/i'],
        ];
    }
}
