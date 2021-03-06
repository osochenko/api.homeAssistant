<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TypeUtility extends Model
{
    public $timestamps = false;

    public function utilityIndications(): HasMany
    {
        return $this->hasMany(UtilityIndication::class);
    }

    public function rateRules(): HasMany
    {
        return $this->hasMany(UtilityRateRule::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
