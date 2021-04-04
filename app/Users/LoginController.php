<?php

namespace App\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // $request->session()->regenerate();
            $user = \Auth::user();
            $token = $user->createToken('auth');
            return [
                'token' => $token->plainTextToken,
                'user' => $user
            ];
        }

        return response('', 401);
    }

    public function logout()
    {
        \Auth::user()->currentAccessToken()->delete();

    }
}