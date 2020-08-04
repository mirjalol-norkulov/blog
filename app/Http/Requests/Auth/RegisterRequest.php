<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'agree' => 'required|accepted'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ismni kiritish majburiy.',
            'name.max' => "Ism 255 ta belgidan kam bo'lishi lozim.",
            'email.required' => "Emailni kiritish majburiy.",
            'email.email' => "Emailni to'g'ri formatda kiriting.",
            'email.unique' => "Bunday email manzilli foydalanuvchi mavjud.",
            'password.required' => "Parolni kiritish majburiy.",
            'password.min' => "Parol kamida 6 ta beligan iborat bo'lishi lozim.",
            'password_confirmation.required' => "Parolni tasdiqlang",
            'password_confirmation.same' => "Parollar bir biriga mos kelmaydi",
            'agree.required' => "Foydalanish shartlariga rozi bo'ling",
            'agree.accepted' => "Foydalanish shartlariga rozi bo'ling"
        ];
    }
}
