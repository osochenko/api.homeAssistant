<?php

declare(strict_types=1);

namespace App\Http\Controllers\Utility;

use App\Http\Resources\UtilityRateRuleCollectionResource;
use App\Models\UtilityRateRule;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Transformers\UtilityRateRuleTransformer;

class UtilityRateRuleController extends Controller
{
    /**
     * UtilityIndicationController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the Utility Indication.
     *
     * @return UtilityRateRuleCollectionResource
     */
    public function index(): UtilityRateRuleCollectionResource
    {
        $rateRules = UtilityRateRule::whereHas('typeUtility', function ($query) {
            $query->where('user_id', '=', auth()->user()->id);
        })->get();

        return new UtilityRateRuleCollectionResource($rateRules);
    }
}
