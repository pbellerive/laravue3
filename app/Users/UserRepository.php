<?php

namespace App\Users;

use Illuminate\Support\Facades\Validator;

class UserRepository
{
    public function find($userId)
    {
        return User::find($userId);
    }

    public function update($user, $params)
    {
        Validator::make($params, [
                   'first_name' => 'required | sometimes',
                   'last_name' => 'required | sometimes',
                   'email' => [
                        'sometimes',
                       'required',
                       'email:rfc',
                        \Illuminate\Validation\Rule::unique('users')->ignore(\Auth::id()),
                        'max:512'
                   ],
                   'password' => 'sometimes | required | confirmed'
               ])->validate();


        if (isset($params['password'])) {
            $params['password'] = password_hash($params['password'], PASSWORD_DEFAULT);
        }

        $user->fill($params);
        $user->save();
    }


}
