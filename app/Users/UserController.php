<?php

namespace App\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return User::paginate();
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getCurrentUser()
    {
        return \Auth::user();
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $this->authorize($user);
        $params = $request->all();

        \Validator::make($request->all(), [
            'email' => [
                'sometimes',
                'email:rfc',
                'required',
                \Illuminate\Validation\Rule::unique('users')->ignore($user->id),
                'max:512'
            ],
            'birth_date' => 'date_format:Y-m-d|before:today',
            'password' => [
                'sometimes',
                'confirmed'
            ]
        ])->validate();

        if (isset($params['password'])) {
            $user->password = password_hash($params['password'], PASSWORD_DEFAULT);
        }

        $user->fill($params);
        $user->save();
    }
}
