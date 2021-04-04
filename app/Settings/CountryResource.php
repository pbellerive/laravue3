<?php

namespace App\Settings;

use App\Http\Resources\BaseJsonResource;

class CountryResource extends BaseJsonResource
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
            'value' => $this->id,
            'text' => $this->when($this->addField('name'), $this->name),
        ];
    }
}
