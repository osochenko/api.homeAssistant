<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\Currency;
use App\Http\Controllers\Controller;
use App\Http\Resources\Currency as CurrencyResource;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the Currency.
     */
    public function index()
    {
        return CurrencyResource::collection(Currency::all());
    }
}
