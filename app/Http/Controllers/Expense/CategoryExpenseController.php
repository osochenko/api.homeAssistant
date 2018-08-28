<?php

declare(strict_types=1);

namespace App\Http\Controllers\Expense;

use Exception;
use App\Models\CategoryExpense;
use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse};
use App\Http\Resources\CategoryExpenseCollectionResource;

class CategoryExpenseController extends Controller
{
    /**
     * Display a listing of the categoryExpense.
     *
     * @return CategoryExpenseCollectionResource
     */
    public function index(): CategoryExpenseCollectionResource
    {
        return new CategoryExpenseCollectionResource(CategoryExpense::all());
    }

    /**
     * Store a new categoryExpense.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     * @throws \Throwable
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $categoryExpense = new CategoryExpense();

            $categoryExpense->user_id = auth()->user()->id;
            $categoryExpense->name = $request->input('name');
            $categoryExpense->is_edible = $request->input('is_edible', 0);
            $categoryExpense->color = $request->input('color');

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
     * @param  Request         $request
     *
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update(CategoryExpense $categoryExpense, Request $request): JsonResponse
    {
        try {
            $categoryExpense->name = $request->input('name');
            $categoryExpense->is_edible = $request->input('is_edible', false);
            $categoryExpense->color = $request->input('color');

            $categoryExpense->saveOrFail();

            return response()->json(['message' => 'Category updated.'], 204);
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

            return response()->json(['message' => 'Category deleted.'], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }
}
