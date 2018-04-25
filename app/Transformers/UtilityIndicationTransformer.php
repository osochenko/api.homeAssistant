<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\UtilityIndication;
use League\Fractal\TransformerAbstract;

class UtilityIndicationTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param UtilityIndication $utility
     * @return array
     */
    public function transform(UtilityIndication $utility): array
    {
        return [
            'id' => $utility->id,
            'amount' => $utility->amount,
            'date' => $utility->date->toDateString(),
            'type' => $utility->type_id,
        ];
    }
}
