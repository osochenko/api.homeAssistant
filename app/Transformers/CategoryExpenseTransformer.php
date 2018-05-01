<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\CategoryExpense;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class CategoryExpenseTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param CategoryExpense $categoryExpense
     * @return array
     */
    public function transform(CategoryExpense $categoryExpense): array
    {
        return [
            'id' => $categoryExpense->id,
            'name' => $categoryExpense->name,
            'description' => $categoryExpense->description,
            'color' => $categoryExpense->color,
            'isEdible' => $categoryExpense->is_edible
        ];
    }
}
