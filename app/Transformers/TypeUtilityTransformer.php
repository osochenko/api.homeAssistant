<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\TypeUtility;
use League\Fractal\TransformerAbstract;

class TypeUtilityTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param TypeUtility $typeUtility
     * @return array
     */
    public function transform(TypeUtility $typeUtility): array
    {
        return [
            'id' => $typeUtility->id,
            'name' => $typeUtility->name,
            'unit' => $typeUtility->unit,
            'rateRules' => $typeUtility->rateRules->pluck('id'),
            'currency' => $typeUtility->currency->id,
        ];
    }
}
