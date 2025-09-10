<?php

namespace App\Actions\Fortify;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CustomLoginHandler
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'username' => 'required',
            'captcha' => [
            'required','numeric',
            function ($attribute, $value, $fail) {
                if (!verify_captcha($value)) {
                    $fail('Jawaban CAPTCHA salah Boss');
                }
            },
        ],
        ]);
        $username = $request->username;
    //dd($request->all());
        $user = User::where('username', $username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return $user;
        }

        return null;
    }
}
