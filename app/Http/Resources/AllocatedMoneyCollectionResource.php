<?php

namespace App\Http\Resources;

use App\Models\AllocatedMoney;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AllocatedMoneyCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function (AllocatedMoney $allocatedMoney) {
            return [
                'id' => $allocatedMoney->id,
                'price' => $allocatedMoney->price,
                'description' => $allocatedMoney->description,
            ];
        })->toArray();
    }
}
