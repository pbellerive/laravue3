<?php

namespace App\Roles;

class RoleRepository
{
    public function create($params)
    {
        $obj = new Role($params);
        //$obj->owner_id = \Auth::id();

        $obj->save();
    }

    public function get($options=[])
    {
        $obj =  Role::query();

        $per_page = array_key_exists('per_page', $options) ? $options['per_page'] : 10;

        return $obj->orderBy('created_at', 'desc')->paginate($per_page);
    }

    public function update($role, $params)
    {
        $role->fill($params);
        $role->save();
    }
}
