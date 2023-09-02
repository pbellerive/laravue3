<?php

namespace App\Users;

use App\Http\Resources\BaseJsonResource;
use App\Roles\RoleResourceCollection;

class UserResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'isAdmin' => $this->hasRole('admin'),
            'fullName' => $this->when($this->addField('fullName'), $this->fullName),
            'first_name' => $this->when($this->addField('first_name'), $this->first_name),
            'last_name' => $this->when($this->addField('last_name'), $this->last_name),
            'email' => $this->when($this->addField('email'), $this->email),
            'roles' => $this->when($this->addField('roles'), new RoleResourceCollection($this->roles)),
            'permissions' => $this->when($this->addField('permissions'), $this->permissions->pluck('id')),
        ];
    }
}
