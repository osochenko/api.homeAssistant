<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
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
            'category' => $this->category_id,
            'currency' => $this->currency_id,
            'price' => $this->price,
            'is_general' => $this->is_general,
            'description' => $this->description,
            'date' => $this->date->toDateString(),
        ];
    }
}
