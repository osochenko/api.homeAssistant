<?php

namespace App\Http\Resources;

use App\Wage;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WageCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function (Wage $wage) {
            return [
                'id' => $wage->id,
                'code' => $wage->code,
                'name' => $wage->name,
            ];
        })->toArray();
    }
}
