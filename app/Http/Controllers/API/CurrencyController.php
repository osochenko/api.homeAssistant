<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\Currency;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Transformers\CurrencyTransformer;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the Currency.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(fractal(Currency::all(), new CurrencyTransformer()));
    }
}
