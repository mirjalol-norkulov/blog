<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;

/**
 * Class LoginController
 * @package App\Http\Controllers\Dashboard\Auth
 */
class LoginController extends Controller
{
    public function loginView()
    {
        return view('auth.login');
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

        if (!$user->hasRole('admin')) {
            return back()->withErrors(['error' => "Sizda ruxsat yo'q"]);
        }

        Auth::login($user, $request->get('remember', false));

        return redirect()->route('homepage');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
