<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UtilityRateRule extends Model
{
    public function typeUtility(): BelongsTo
    {
        return $this->belongsTo(TypeUtility::class);
    }
}
