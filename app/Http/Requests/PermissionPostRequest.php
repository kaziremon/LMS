<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PermissionPostRequest extends FormRequest
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
            'module_id' => 'required',
            'name' => ['required','string', Rule::unique('permissions')->whereNull('deleted_at')],
            'slug' => ['required','string', Rule::unique('permissions')->whereNull('deleted_at')]

        ];
    }
}
