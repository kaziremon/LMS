<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'password' => ['nullable', 'string', 'min:6'],
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'role_id'=>['required'],
            'name' => ['required','string','max:20',Rule::unique('users')->ignore($this->user)->whereNull('deleted_at')],
            'email' => ['required','string','email','max:255', Rule::unique('users')->ignore($this->user)->whereNull('deleted_at')],
            'full_name'=>['required'],
        ];
    }
}
