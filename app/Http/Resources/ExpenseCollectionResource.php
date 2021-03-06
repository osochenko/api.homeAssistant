<?php

namespace App\Http\Resources;

use App\Expense;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ExpenseCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function (Expense $expense) {
            return [
                'id' => $expense->id,
                'category' => $expense->category_id,
                'currency' => $expense->currency_id,
                'price' => $expense->price,
                'is_general' => $expense->is_general,
                'description' => $expense->description,
                'date' => $expense->date->toDateString(),
            ];
        })->toArray();
    }
}
