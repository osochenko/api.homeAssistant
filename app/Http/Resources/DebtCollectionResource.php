<?php

namespace App\Http\Resources;

use App\Models\Debt;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DebtCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function (Debt $debt) {
            return [
                'id' => $debt->id,
                'is_your' => $debt->is_your,
                'name' => $debt->name,
                'amount' => $debt->amount,
                'currency' => $debt->currency_id,
                'description' => $debt->description,
            ];
        })->toArray();
    }
}
