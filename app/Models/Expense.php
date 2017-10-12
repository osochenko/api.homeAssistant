<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    protected $dates = [
        'date',
    ];

    public $timestamps = false;

    public function type(): BelongsTo
    {
        return $this->belongsTo(TypeExpense::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
