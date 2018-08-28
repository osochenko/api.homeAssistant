<?php

namespace App\Http\Resources;

use App\Models\Currency;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CurrencyCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function (Currency $currency) {
            return [
                'id' => $currency->id,
                'code' => $currency->code,
                'name' => $currency->name,
            ];
        })->toArray();
    }
}
