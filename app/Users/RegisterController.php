<?php

namespace App\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Users\User;

class RegisterController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $params = $request->all();

        if (isset($params['preferred_locale'])) {
            \App::setlocale($params['preferred_locale']);
        }

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'birth_date' => 'date_format:Y-m-d|before:today',
            'email' => [
                'required',
                'email:rfc',
                'required',
                 \Illuminate\Validation\Rule::unique('users'),
                 'max:512'
            ],
            'password' => 'required | confirmed'
        ]);

        $newUser = new User($params);
        $newUser->password = password_hash($request->input('password'), PASSWORD_BCRYPT);
        $newUser->save();

        $newUser->refresh();
        $newUser->assignRole('client');
    }
}