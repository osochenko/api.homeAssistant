<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Expense;

use Carbon\Carbon;
use Exception;
use App\Models\Expense;
use App\Http\Controllers\Controller;
use App\Transformers\ExpenseTransformer;
use Illuminate\Http\{Request, JsonResponse};

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the expense.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(fractal(auth()->user()->expenses, new ExpenseTransformer()));
    }

    /**
     * Store a new expense.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $receivedExpense = $request->all();

            $expense = new Expense();

            $expense->user_id = auth()->user()->id;
            $expense->type_id = $receivedExpense['type']['id'];
            $expense->currency_id = $receivedExpense['currency']['id'];
            $expense->price = $receivedExpense['price'];
            $expense->created_at = Carbon::parse($receivedExpense['date']);
            $expense->updated_at = Carbon::parse($receivedExpense['date']);

            $expense->saveOrFail();

            return response()->json([], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Update expense.
     *
     * @param  Expense $expense
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function update(Expense $expense, Request $request): JsonResponse
    {
        try {
            $receivedExpense = $request->all();

            $expense->type_id = $receivedExpense['type']['id'];
            $expense->currency_id = $receivedExpense['currency']['id'];
            $expense->price = $receivedExpense['price'];
            $expense->created_at = Carbon::parse($receivedExpense['date']);
            $expense->updated_at = Carbon::parse($receivedExpense['date']);

            $expense->saveOrFail();

//            return response()->json([], 204);
            return response()->json(['date' => Carbon::parse($receivedExpense['date'])->toDateTimeString()]);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Remove expense.
     *
     * @param  Expense $expense
     *
     * @return JsonResponse
     */
    public function destroy(Expense $expense): JsonResponse
    {
        try {
            $expense->delete();

            return response()->json([], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }
}
