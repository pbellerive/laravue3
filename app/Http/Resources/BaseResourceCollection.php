<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Str;

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
        if ($resource instanceof MissingValue or is_array($resource)) {
            $this->collection = $resource;
            return $this->collection;
        }

        $collects = $this->collects();

        $this->collection = $collects && !$resource->first() instanceof $collects
            ? $this->mapInto($collects, $resource)
            : $resource->toBase();

        return $resource instanceof AbstractPaginator
            ? $resource->setCollection($this->collection)
            : $this->collection;
    }

    public function toArray($request)
    {
        if ($this->collection instanceof \Illuminate\Support\Collection) {
            return parent::toArray($request);
        }

        $resources = [];

        $classResource = null;
        if (Str::endsWith(class_basename($this), 'Collection') &&
            (class_exists($class = Str::replaceLast('Collection', '', get_class($this))) ||
            class_exists($class = Str::replaceLast('Collection', 'Resource', get_class($this))))) {

            $classResource = $class;
        }

        foreach($this->collection['hits'] as $item) {
            $resources[] = (new  $classResource($item, $this->fields))->toArray(null);
        }

        return [
            'data' => $resources,
            'meta' => [
                'total' => $this->collection['totalHits'],
                'per_page' => $this->collection['hitsPerPage'],
                'current_page' => $this->collection['page'],
            ]
        ];
    }

    public function mapInto($class, $resource)
    {
        $fields = $this->fields;
        return $resource->map(function ($value, $key) use ($class, $fields) {
            return new $class($value, $fields);
        });
    }
}
