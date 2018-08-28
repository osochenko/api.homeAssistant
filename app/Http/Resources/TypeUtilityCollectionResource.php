<?php

namespace App\Http\Resources;

use App\Models\TypeUtility;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TypeUtilityCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function (TypeUtility $typeUtility) {
            return [
                'id' => $typeUtility->id,
                'name' => $typeUtility->name,
                'unit' => $typeUtility->unit,
                'rate_rules' => $typeUtility->rateRules->pluck('id'),
                'currency' => $typeUtility->currency_id,
            ];
        })->toArray();
    }
}
