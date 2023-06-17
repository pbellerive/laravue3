<?php

namespace App\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravue3\Stateless\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    public $appends = ['fullName'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'birth_date',
        'address',
        'city',
        'state_id',
        'country_id',
        'postal_code',
        'preferred_locale',
        'phone_number',
        'cell_phone_number',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function assignPermission($permission)
    {
        $this->permissions()->attach($permission->id);
    }

    public function assignRole($role)
    {
        $model = $role;

        if (gettype($role) === 'string') {
            $model = \App\Roles\Role::where('name', '=', $role)->first();
        }

        $this->roles()->attach($model->id);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function hasPermission($permission)
    {
        $hasPermissionFromRole = $this->roles()->join('permission_role', 'permission_role.role_id', '=', 'roles.id')->join('permissions', 'permission_id', '=', 'permissions.id')->where('permissions.name', '=', $permission)->exists();

        $hasPermission = $this->permissions()->where('permission_user.name', '=', $permission);

        return $hasPermission || $hasPermissionFromRole;
    }

    public function hasRole($roleName)
    {
        return $this->roles()->where('name', '=', $roleName)->exists();
    }

    public function permissions()
    {
        return $this->belongsToMany('\App\Permissions\Permission');
    }

    public function removePermission($permission)
    {
        $this->permissions()->detach($permission->id);
    }

    public function roles()
    {
        return $this->belongsToMany('\App\Roles\Role');
    }

}
