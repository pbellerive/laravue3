<?php

namespace App\Roles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', ];

    public function permissions()
    {
        return $this->belongsToMany('\App\Permissions\Permission');
    }

    public function assignPermission($permission)
    {
        $model = $permission;

        if (gettype($permission) === 'string') {
            $model = \App\Permissions\Permission::where('name', '=', $permission)->first();
        }

        $this->permissions()->attach($model->id);
    }

    public function removePermission($permission)
    {
        $this->permissions()->detach($permission->id);
    }

    public function hasPermission($permissionName)
    {
        return $this->permissions()->where('permissions.name', '=', $permissionName)->exists();
    }

}
