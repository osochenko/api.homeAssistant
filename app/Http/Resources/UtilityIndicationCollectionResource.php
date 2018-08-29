<?php

namespace App\Http\Resources;

use App\UtilityIndication;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UtilityIndicationCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function (UtilityIndication $utility) {
            return [
                'id' => $utility->id,
                'amount' => $utility->amount,
                'date' => $utility->date->toDateString(),
                'type' => $utility->type_id,
            ];
        })->toArray();
    }
}
