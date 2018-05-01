<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\Expense;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class ExpenseTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Expense $expense
     * @return array
     */
    public function transform(Expense $expense): array
    {
        return [
            'id' => $expense->id,
            'category' => $expense->category_id,
            'currency' => $expense->currency_id,
            'price' => $expense->price,
            'isGeneral' => $expense->is_general,
            'description' => $expense->description,
            'date' => $expense->date->toDateString(),
        ];
    }
}
