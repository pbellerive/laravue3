<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
class BaseJsonResource extends JsonResource
{
    protected $fields = null;

    public function __construct($resource, $fields = null)
    {
        parent::__construct($resource);
        $this->fields = $fields;
    }

    public function addField($fieldName)
    {
        return (is_null($this->fields) || (isset($this->fields) && array_search($fieldName, $this->fields) !== false));
    }
}
