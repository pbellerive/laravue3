<?php

namespace App\Permissions;

class PermissionRepository
{
    public function create($params)
    {
        $obj = new Permission($params);
        //$obj->owner_id = \Auth::id();

        $obj->save();
    }

    public function get($options=[])
    {
        $obj =  Permission::query();

        $per_page = array_key_exists('per_page', $options) ? $options['per_page'] : 10;

        return $obj->orderBy('created_at', 'desc')->paginate($per_page);
    }

    public function update($permission, $params)
    {
        $permission->fill($params);
        $permission->save();
    }
}
