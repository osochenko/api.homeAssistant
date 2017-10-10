<?php

declare(strict_types=1);

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get all user expenses items.
     *
     * @return HasMany
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    /**
     * Get all user types expenses items.
     *
     * @return HasMany
     */
    public function typeExpenses(): HasMany
    {
        return $this->hasMany(TypeExpense::class);
    }

    /**
     * Get all user debts.
     *
     * @return HasMany
     */
    public function debts(): HasMany
    {
        return $this->hasMany(Debt::class);
    }

    /**
     * Get all user deposits.
     *
     * @return HasMany
     */
    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class);
    }

    /**
     * Get all user wages.
     *
     * @return HasMany
     */
    public function wages(): HasMany
    {
        return $this->hasMany(Wage::class);
    }

    /**
     * Get all user wages percentage distributions.
     *
     * @return HasMany
     */
    public function wagePercentageDistributions(): HasMany
    {
        return $this->hasMany(WagePercentageDistribution::class);
    }

    /**
     * Get all user utility indications.
     *
     * @return HasMany
     */
    public function utilityIndications(): HasMany
    {
        return $this->hasMany(UtilityIndication::class);
    }

    /**
     * Get all user types utility.
     *
     * @return HasMany
     */
    public function typeUtility(): HasMany
    {
        return $this->hasMany(TypeUtility::class);
    }

    /**
     * Get all user allocated moneys.
     *
     * @return HasMany
     */
    public function allocatedMoneys(): HasMany
    {
        return $this->hasMany(AllocatedMoney::class);
    }

    /**
     * Get all user type allocated moneys.
     *
     * @return HasMany
     */
    public function typeAllocatedMoneys(): HasMany
    {
        return $this->hasMany(TypeAllocatedMoney::class);
    }
}
