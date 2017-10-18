<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\TypeUtility;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class TypeUtilityTransformer extends TransformerAbstract
{
    /**
     * Include resources without needing it to be requested.
     *
     * @var array
     */
    protected $defaultIncludes = [
        'currency'
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
            'rate' => $typeUtility->rate,
            'unit' => $typeUtility->unit,
        ];
    }

    /**
     * Include typeUtility currency.
     *
     * @param TypeUtility $typeUtility
     * @return Item
     */
    public function includeCurrency(TypeUtility $typeUtility): Item
    {
        return $this->item($typeUtility->currency, new CurrencyTransformer());
    }
}
