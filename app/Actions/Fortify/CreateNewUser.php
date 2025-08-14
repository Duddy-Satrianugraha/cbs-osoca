<?php

namespace App\Actions\Fortify;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        if($input['code'] == '2932e5e2847f0af22ef9d54eb6aebda7'){
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'username' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'password' => $this->passwordRules(),
                'captcha' => [
                                'required','numeric',
                                function ($attribute, $value, $fail) {
                                    if (!verify_captcha($value)) {
                                        $fail('Jawaban CAPTCHA salah Boss, gimana sih');
                                    }
                                },
                            ],
            ])->validate();
            $slug = md5($input['username']);
            $username = $input['username'];
            $role = Role::where('u_id', 6)->first()->id;

                        }elseif($input['code'] == '2930e5e2847f0af22ef9d54eb6aebda7'){
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'username' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'password' => $this->passwordRules(),
                'captcha' => [
                                'required','numeric',
                                function ($attribute, $value, $fail) {
                                    if (!verify_captcha($value)) {
                                        $fail('Jawaban CAPTCHA salah Boss, gimana sih');
                                    }
                                },
                            ],
            ])->validate();
            $slug = md5($input['username']);
            $username = $input['username'];
            $role = Role::where('u_id', 5)->first()->id;
        } else {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'npm' => [
                'required',
                'string',
                'max:255',
                Rule::unique(User::class),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'captcha' => [
                            'required','numeric',
                            function ($attribute, $value, $fail) {
                                if (!verify_captcha($value)) {
                                    $fail('Jawaban CAPTCHA salah cuy, gimana sih');
                                }
                            },
                        ],
        ])->validate();
        $slug = md5($input['npm']);
        $username = $input['npm'];
        $role = Role::where('u_id', 4)->first()->id;
                    }
//dd($slug);
        $user = User::create([
            'name' => $input['name'],
            'username' => $username,
            'slug' => $slug,
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        $user->roles()->attach($role);
        return $user;
    }
}
