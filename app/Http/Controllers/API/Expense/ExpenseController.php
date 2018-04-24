<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Expense;

use App\Models\TypeExpense;
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
     * @param int $monthNumber
     *
     * @return JsonResponse
     */
    public function getByMonthNumber($monthNumber): JsonResponse
    {
        $expenseTypeIDs = TypeExpense::where('slug', '!=', 'personal')
            ->pluck('id')
            ->toArray();

        $generalExpenses = Expense::whereMonth('date','=', $monthNumber)
            ->whereIn('type_id', $expenseTypeIDs)
            ->get();

        $personalExpenses = Expense::whereMonth('date','=', $monthNumber)
            ->whereNotIn('type_id', $expenseTypeIDs)
            ->where('user_id', auth()->user()->id)
            ->get();

        $expenses = $generalExpenses->merge($personalExpenses);

        return response()->json(fractal($expenses, new ExpenseTransformer()));
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
            $expense->category_id = $receivedExpense['category']['id'];
            $expense->currency_id = $receivedExpense['currency']['id'];
            $expense->price = $receivedExpense['price'];
            $expense->description = $receivedExpense['description'] ?? null;
            $expense->date = Carbon::parse($receivedExpense['date']);

            $expense->saveOrFail();

            return response()->json(['id' => $expense->id], 201);
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
            $expense->category_id = $receivedExpense['category']['id'];
            $expense->price = $receivedExpense['price'];
            $expense->description = $receivedExpense['description'] ?? null;
            $expense->date = Carbon::parse($receivedExpense['date']);

            $expense->saveOrFail();

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
