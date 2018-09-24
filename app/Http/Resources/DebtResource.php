<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DebtResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'is_your' => $this->is_your,
            'name' => $this->name,
            'amount' => $this->amount,
            'currency' => $this->currency_id,
            'description' => $this->description,
        ];
    }
}
