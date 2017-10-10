<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Models\Currency;
use League\Fractal\TransformerAbstract;

class CurrencyTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Currency $currency
     * @return array
     */
    public function transform(Currency $currency): array
    {
        return [
            'id' => $currency->id,
            'code' => $currency->code,
            'name' => $currency->name,
            'description' => $currency->description,
        ];
    }
}
