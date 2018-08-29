<?php

namespace App\Http\Resources;

use App\Models\TypeAllocatedMoney;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TypeAllocatedMoneyCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function (TypeAllocatedMoney $typeAllocatedMoney) {
            return [
                'id' => $typeAllocatedMoney->id,
                'price' => $typeAllocatedMoney->price,
                'description' => $typeAllocatedMoney->description,
            ];
        })->toArray();
    }
}
