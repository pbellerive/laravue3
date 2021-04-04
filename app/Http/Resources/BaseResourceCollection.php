<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Pagination\AbstractPaginator;

class BaseResourceCollection extends ResourceCollection
{
    protected $fields;

    public function __construct($resource, $fields=null, $collects=null)
    {
        $this->fields = $fields;
        if ($collects) {
            $this->collects = $collects;
        }
        parent::__construct($resource);
    }

    protected function collectResource($resource)
    {
        if ($resource instanceof MissingValue) {
            return $resource;
        }

        $collects = $this->collects();

        $this->collection = $collects && !$resource->first() instanceof $collects
            ? $this->mapInto($collects, $resource)
            : $resource->toBase();

        return $resource instanceof AbstractPaginator
            ? $resource->setCollection($this->collection)
            : $this->collection;
    }

    public function mapInto($class, $resource)
    {
        $fields = $this->fields;
        return $resource->map(function ($value, $key) use ($class, $fields) {
            return new $class($value, $fields);
        });
    }
}