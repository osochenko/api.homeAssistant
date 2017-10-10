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
            foreach ($request->all() as $receivedExpense) {
                $expenseStatus = $receivedExpense['status'];

                switch (true) {
                    case in_array('deleted', $expenseStatus, true):
                        Expense::destroy($receivedExpense['id']);
                        continue 2;
                        break;

                    case in_array('new', $expenseStatus, true):
                        $expense = new Expense();
                        $expense->user_id = auth()->user()->id;
                        $expense->created_at = Carbon::parse($receivedExpense['date']);
                        $expense->updated_at = Carbon::parse($receivedExpense['date']);
                        break;

                    case in_array('updated', $expenseStatus, true):
                        $expense = Expense::find($receivedExpense['id']);
                        $expense->updated_at = Carbon::parse($receivedExpense['date']);
                        break;
                }

                if ($expense !== null) {
                    $expense->type_id = $receivedExpense['type']['id'];
                    $expense->currency_id = $receivedExpense['currency']['id'];
                    $expense->price = $receivedExpense['price'];

//                    if ($request->has('description')) {
//                        $expense->description = $request->input('description');
//                    }

                    $expense->saveOrFail();
                }
            }

            return response()->json([], 201);
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
            $expense->type_id = $request->input('type');
            $expense->currency_id = $request->input('currency');
            $expense->price = $request->input('price');

            if ($request->has('description')) {
                $expense->description = $request->input('description');
            }

            $expense->saveOrFail();

            return response()->json([], 204);
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
