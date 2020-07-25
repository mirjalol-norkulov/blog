<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class LoginController
 * @package App\Http\Controllers\Dashboard\Auth
 */
class LoginController extends Controller
{
    public function loginView()
    {
        return view('dashboard.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ], [
            'email.required' => 'Emailni kiritish talab etiladi',
            'email.email' => "Emailni to'g'ri formatda kiriting",
            'email.exists' => "Bunday email bazada mavjud emas",
            'password.required' => "Parolni kiritish talab etiladi"
        ]);

        $user = User::where('email', $request->get('email'))->first();
        if (!Hash::check($request->get('password'), $user->password)) {
            return back()->withErrors([
                'password' => ["invalid" => "Parol noto'g'ri kiritildi"]
            ]);
        }

        Auth::login($user, $request->get('remember', false));

        return redirect()->route('homepage');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('dashboard.login');
    }
}