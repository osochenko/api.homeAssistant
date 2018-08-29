<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UtilityIndication extends Model
{
    protected $dates = [
        'date',
    ];

    public $timestamps = false;

    public function type(): BelongsTo
    {
        return $this->belongsTo(TypeUtility::class);
    }
}
