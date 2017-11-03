<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\TypeExpense;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class TypeExpenseTransformer extends TransformerAbstract
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
     * @param TypeExpense $typeExpense
     * @return array
     */
    public function transform(TypeExpense $typeExpense): array
    {
        return [
            'id' => $typeExpense->id,
            'slug' => $typeExpense->slug,
            'name' => $typeExpense->name,
        ];
    }

    /**
     * Include expenses by type.
     *
     * @param TypeExpense $typeExpense
     * @return Collection
     */
    public function includeExpenses(TypeExpense $typeExpense): Collection
    {
        return $this->collection($typeExpense->expenses, new ExpenseTransformer());
    }
}
