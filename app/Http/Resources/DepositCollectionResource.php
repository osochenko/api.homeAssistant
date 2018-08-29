<?php

namespace App\Http\Resources;

use App\Deposit;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DepositCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function (Deposit $deposit) {
            return [
                'id' => $deposit->id,
                'price' => $deposit->price,
                'description' => $deposit->description,
            ];
        })->toArray();
    }
}
