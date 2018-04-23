<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Expense;

use Exception;
use App\Models\CategoryExpense;
use App\Http\Controllers\Controller;
use App\Transformers\CategoryExpenseTransformer;
use Illuminate\Http\{Request, JsonResponse};

class CategoryExpenseController extends Controller
{
    /**
     * CategoryExpenseController constructor.
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
        return response()->json(fractal(CategoryExpense::all(), new CategoryExpenseTransformer()));
    }

    /**
     * Store a new categoryExpense.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $categoryExpense = new CategoryExpense();

            $categoryExpense->user_id = auth()->user()->id;
            $categoryExpense->name = $request->input('name');

            if ($request->has('color')) {
                $categoryExpense->color = $request->input('color');
            }

            $categoryExpense->saveOrFail();

            return response()->json(['id' => $categoryExpense->id], 201);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Update categoryExpense.
     *
     * @param  CategoryExpense $categoryExpense
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function update(CategoryExpense $categoryExpense, Request $request): JsonResponse
    {
        try {
            $categoryExpense->name = $request->input('name');

            if ($request->has('color')) {
                $categoryExpense->color = $request->input('color');
            }

            $categoryExpense->saveOrFail();

            return response()->json([], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Remove categoryExpense.
     *
     * @param  CategoryExpense $categoryExpense
     *
     * @return JsonResponse
     */
    public function destroy(CategoryExpense $categoryExpense): JsonResponse
    {
        try {
            $categoryExpense->delete();

            return response()->json([], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }
}
