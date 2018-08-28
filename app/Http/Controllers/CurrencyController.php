<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Http\Resources\CurrencyCollectionResource;

class CurrencyController extends Controller
{
    /**
     * Display a currencies.
     * @return CurrencyCollectionResource
     */
    public function index(): CurrencyCollectionResource
    {
        return new CurrencyCollectionResource(Currency::all());
    }
}
