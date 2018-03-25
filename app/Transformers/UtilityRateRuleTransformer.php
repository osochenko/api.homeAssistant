<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\UtilityRateRule;
use League\Fractal\TransformerAbstract;

class UtilityRateRuleTransformer extends TransformerAbstract
{

    /**
     * A Fractal transformer.
     *
     * @param UtilityRateRule $utilityRateRule
     * @return array
     */
    public function transform(UtilityRateRule $utilityRateRule): array
    {
        return [
            'id' => $utilityRateRule->id,
            'rate' => round($utilityRateRule->rate, 2 ),
            'limit' => $utilityRateRule->limit,
        ];
    }
}
