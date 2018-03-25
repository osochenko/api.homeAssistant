<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\TypeUtility;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class TypeUtilityTransformer extends TransformerAbstract
{
    /**
     * Include resources without needing it to be requested.
     *
     * @var array
     */
    protected $defaultIncludes = [
        'rateRules'
    ];

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
        ];
    }

    /**
     * Include typeUtility rate rules.
     *
     * @param TypeUtility $typeUtility
     * @return Collection
     */
    public function includeRateRules(TypeUtility $typeUtility): Collection
    {
        return $this->collection($typeUtility->rateRules, new UtilityRateRuleTransformer());
    }
}

