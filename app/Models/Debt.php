<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Debt extends Model
{
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
