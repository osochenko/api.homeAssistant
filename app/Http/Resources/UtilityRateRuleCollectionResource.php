<?php

namespace App\Http\Resources;

use App\UtilityRateRule;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UtilityRateRuleCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function (UtilityRateRule $utilityRateRule) {
            return [
                'id' => $utilityRateRule->id,
                'rate' => round($utilityRateRule->rate, 2 ),
                'limit' => $utilityRateRule->limit,
            ];
        })->toArray();
    }
}
