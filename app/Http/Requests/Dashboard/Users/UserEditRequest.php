<?php

namespace App\Http\Requests\Dashboard\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'name' => 'max:255',
            'email' => 'email|unique:users,email,' . $this->route('id'),
            'roles' => 'array',
            'roles.*' => 'string|exists:roles,id',
            'password' => 'nullable|min:6',
            'password_confirm' => 'nullable|same:password'
        ];
    }
}
