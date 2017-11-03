<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\CategoryExpense;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class CategoryExpenseTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'expenses',
    ];

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
        ];
    }

    /**
     * Include expenses by category.
     *
     * @param CategoryExpense $categoryExpense
     * @return Collection
     */
    public function includeExpenses(CategoryExpense $categoryExpense): Collection
    {
        return $this->collection($categoryExpense->expenses, new ExpenseTransformer());
    }
}
