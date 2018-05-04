<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\Debt;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class DebtTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Debt $debt
     *
     * @return array
     */
    public function transform(Debt $debt): array
    {
        return [
            'id' => $debt->id,
            'isYour' => $debt->is_your,
            'name' => $debt->name,
            'amount' => $debt->amount,
            'currency' => $debt->currency_id,
            'description' => $debt->description,
        ];
    }
}
