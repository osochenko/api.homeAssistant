<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeExpense extends Model
{
    public $timestamps = false;

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }
}
