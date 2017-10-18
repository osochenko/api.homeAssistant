<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\UtilityIndication;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class UtilityIndicationTransformer extends TransformerAbstract
{
    /**
     * Include resources without needing it to be requested.
     *
     * @var array
     */
    protected $defaultIncludes = [
        'type',
    ];

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
        ];
    }

    /**
     * Include type of utility.
     *
     * @param UtilityIndication $utility
     * @return Item
     */
    public function includeType(UtilityIndication $utility): Item
    {
        return $this->item($utility->type, new TypeUtilityTransformer());
    }
}
