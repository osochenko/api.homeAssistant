<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\UtilityRateRule;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Item;

class UtilityRateRuleTransformer extends TransformerAbstract
{
    /**
     * Include resources without needing it to be requested.
     *
     * @var array
     */
    protected $defaultIncludes = [
        'currency',
    ];

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

    /**
     * Include Utility rate rule currency.
     *
     * @param UtilityRateRule $utilityRateRule
     * @return Item
     */
    public function includeCurrency(UtilityRateRule $utilityRateRule): Item
    {
        return $this->item($utilityRateRule->currency, new CurrencyTransformer());
    }
}
