<?php

declare(strict_types=1);

namespace App\Http\Controllers\Expense;

use Exception;
use Carbon\Carbon;
use App\Expense;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\{
    Request, JsonResponse, Resources\Json\AnonymousResourceCollection
};
use App\Http\Resources\ExpenseResource;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the expense.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ExpenseResource::collection(auth()->user()->expenses);
    }

    /**
     * @param int $month
     * @param int $year
     *
     * @return AnonymousResourceCollection
     */
    public function getByMonthAndYear($year, $month): AnonymousResourceCollection
    {
        $expenses = Expense::query()
            ->whereYear('date','=', $year)
            ->whereMonth('date','=', $month)
//            ->where('user_id', auth()->user()->id)
            ->get();
        return ExpenseResource::collection($expenses);
    }

    /**
     * Store a new expense.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     * @throws \Throwable
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $receivedExpense = $request->all();

            $expense = new Expense();

            $expense->user_id = auth()->user()->id;
            $expense->category_id = $receivedExpense['category_id'];
            $expense->currency_id = $receivedExpense['currency_id'];
            $expense->price = $receivedExpense['price'];
            $expense->is_general = $receivedExpense['is_general'];
            $expense->description = $receivedExpense['description'] ?? null;
            $expense->date = Carbon::parse($receivedExpense['date']);

            $expense->saveOrFail();

            return response()->json(['message' => 'Expense created.'], 201);
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
     * @throws \Throwable
     */
    public function update(Expense $expense, Request $request): JsonResponse
    {
        try {
            $receivedExpense = $request->all();

            $expense->currency_id = $receivedExpense['currency_id'];
            $expense->category_id = $receivedExpense['category_id'];
            $expense->is_general = $receivedExpense['is_general'];
            $expense->price = $receivedExpense['price'];
            $expense->description = $receivedExpense['description'] ?? null;
            $expense->date = Carbon::parse($receivedExpense['date']);

            $expense->saveOrFail();

            return response()->json(['message' => 'Expense updated.']);
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

            return response()->json(['message' => 'Delete expense success.'], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }
}
