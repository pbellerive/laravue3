<?php

namespace App\ModuleA;

use App\Http\Resources\BaseJsonResource;

class ModuleAResource extends BaseJsonResource
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
            'name' => $this->when($this->addField('name'), $this->name),
        ];
    }
}
