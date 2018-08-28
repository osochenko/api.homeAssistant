<?php

namespace App\Http\Resources;

use App\Models\CategoryExpense;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryExpenseCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function (CategoryExpense $categoryExpense) {
            return [
                'id' => $categoryExpense->id,
                'name' => $categoryExpense->name,
                'description' => $categoryExpense->description,
                'color' => $categoryExpense->color,
                'isEdible' => $categoryExpense->is_edible,
            ];
        })->toArray();
    }
}
