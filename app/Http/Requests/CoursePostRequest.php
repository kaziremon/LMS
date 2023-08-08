<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CoursePostRequest extends FormRequest
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
            'title' => ['required','regex:/^\S*$/u', Rule::unique('courses')->whereNull('deleted_at')]
        ];
    }

    public function messages()
    {
        return [
                'title.regex' => 'Whitespace not allowed.',
        ];
    }
    
}
