<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Http\Resources\CurrencyResource;

class CurrencyController extends Controller
{
    /**
     * Display a currencies.
     * @return CurrencyResource
     */
    public function index(): CurrencyResource
    {
        return new CurrencyResource(Currency::all());
    }
}
