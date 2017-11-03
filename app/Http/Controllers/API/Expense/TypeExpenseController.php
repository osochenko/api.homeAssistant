<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Expense;

use App\Models\TypeExpense;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Transformers\TypeExpenseTransformer;

class TypeExpenseController extends Controller
{
    /**
     * TypeExpenseController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the categoryExpense.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(fractal(TypeExpense::all(), new TypeExpenseTransformer()));
    }
}
