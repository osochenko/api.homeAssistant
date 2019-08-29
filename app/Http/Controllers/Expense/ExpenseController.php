<?php

declare(strict_types=1);

namespace App\Http\Controllers\Expense;

use Exception;
use Carbon\Carbon;
use App\Expense;
use App\ExpenseProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\{
    Request, JsonResponse, Resources\Json\AnonymousResourceCollection
};
use App\Http\Resources\ExpenseResource;

class ExpenseController extends Controller
{
    public function __construct()
    {
        sleep(2);
    }
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
            foreach ($request->products as $product) {
                $expenseProduct = ExpenseProduct::query()
                    ->where('name', $product)
                    ->first();
                if (!$expenseProduct) {
                    ExpenseProduct::create([
                        'name' => $product,
                        'category_id' => $request->category_id,
                    ]);
                }
            }

            $expense = new Expense();

            $expense->user_id = auth()->user()->id;
            $expense->category_id = $request->category_id;
            $expense->event_id = $request->event_id;
            $expense->currency_id = $request->currency_id;
            $expense->price = $request->price;
            $expense->is_general = $request->is_general;
            $expense->products = $request->products;
            $expense->date = Carbon::parse($request->date);

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
            foreach ($request->products as $product) {
                $expenseProduct = ExpenseProduct::query()
                    ->where('name', $product)
                    ->first();
                if (!$expenseProduct) {
                    ExpenseProduct::create([
                        'name' => $product,
                        'category_id' => $request->category_id,
                    ]);
                }
            }

            $expense->category_id = $request->category_id;
            $expense->event_id = $request->event_id;
            $expense->currency_id = $request->currency_id;
            $expense->price = $request->price;
            $expense->is_general = $request->is_general;
            $expense->products = $request->products;
            $expense->date = Carbon::parse($request->date);

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
