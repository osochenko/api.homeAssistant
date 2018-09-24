<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Currency;
use App\Http\Resources\CurrencyResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CurrencyController extends Controller
{
    /**
     * Display a currencies.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return CurrencyResource::collection(Currency::all());
    }
}
