<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\Expense;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class ExpenseTransformer extends TransformerAbstract
{
    /**
     * Include resources without needing it to be requested.
     *
     * @var array
     */
    protected $defaultIncludes = [
        'currency',
        'type',
        'category',
    ];

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
            'userId' => $expense->user_id,
            'price' => $expense->price,
            'description' => $expense->description,
            'date' => $expense->date->toDateString(),
        ];
    }

    /**
     * Include expense currency.
     *
     * @param Expense $expense
     * @return Item
     */
    public function includeCurrency(Expense $expense): Item
    {
        return $this->item($expense->currency, new CurrencyTransformer());
    }

    /**
     * Include type of expense.
     *
     * @param Expense $expense
     * @return Item
     */
    public function includeType(Expense $expense): Item
    {
        return $this->item($expense->type, new TypeExpenseTransformer());
    }

    /**
     * Include category of expense.
     *
     * @param Expense $expense
     * @return Item
     */
    public function includeCategory(Expense $expense): Item
    {
        return $this->item($expense->category, new CategoryExpenseTransformer());
    }
}
