<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}

