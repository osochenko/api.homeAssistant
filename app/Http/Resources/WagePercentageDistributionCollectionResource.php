<?php

namespace App\Http\Resources;

use App\Models\WagePercentageDistribution;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WagePercentageDistributionCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function (WagePercentageDistribution $wagePercentageDistribution) {
            return [
                'id' => $wagePercentageDistribution->id,
                'code' => $wagePercentageDistribution->code,
                'name' => $wagePercentageDistribution->name,
            ];
        })->toArray();
    }
}
