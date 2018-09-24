<?php

declare(strict_types=1);

namespace App\Http\Controllers\Utility;

use App\UtilityRateRule;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\UtilityRateRuleResource;

class UtilityRateRuleController extends Controller
{
    /**
     * Display a listing of the Utility Indication.
     * @return UtilityRateRuleResource
     */
    public function index(): UtilityRateRuleResource
    {
        $rateRules = UtilityRateRule::query()->whereHas('typeUtility', function (Builder $query) {
            $query->where('user_id', '=', auth()->user()->id);
        })->get();

        return new UtilityRateRuleResource($rateRules);
    }
}
