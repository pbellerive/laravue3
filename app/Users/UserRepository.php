<?php

namespace App\Users;

use Illuminate\Support\Facades\Validator;

class UserRepository
{
    public function assignRole($user, $role)
    {
        $model = $role;

        if (gettype($role) === 'string') {
            $model = \App\Roles\Role::where('name', '=', $role)->first();
        }

        //can't add twice
        if ($user->hasRole($model->name)) {
            return;
        }

        $user->roles()->attach($model->id);
    }

    public function removeRole($user, $role)
    {
        $user->roles()->detach($role->id);
    }

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
                        \Illuminate\Validation\Rule::unique('users')->ignore($user->id),
                        'max:512'
                   ],
                   'password' => 'sometimes | required | confirmed'
               ])->validate();


        if (isset($params['password'])) {
            $params['password'] = password_hash($params['password'], PASSWORD_DEFAULT);
        }

        $user->fill($params);
        $user->save();

        if (isset($params['permissions'])) {
            $this->updatePermissions($user, $params['permissions']);
        }
    }

    public function updatePermissions($user, $permissionIds)
    {
        $user->permissions()->sync($permissionIds);
    }



}
