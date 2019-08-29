<?php

declare(strict_types=1);

namespace App\Http\Controllers\Expense;

use Exception;
use App\ExpenseCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\{
    Request, JsonResponse, Resources\Json\AnonymousResourceCollection
};
use App\Http\Resources\ExpenseCategoryResource;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the category.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ExpenseCategoryResource::collection(ExpenseCategory::all());
    }

    /**
     * Store a new category.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     * @throws \Throwable
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $category = new ExpenseCategory();

            $category->user_id = auth()->user()->id;
            $category->name = $request->input('name');
            $category->is_edible = $request->input('is_edible', 0);
            $category->color = $request->input('color');

            $category->saveOrFail();

            return response()->json(['id' => $category->id], 201);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Update category.
     *
     * @param  ExpenseCategory $category
     * @param  Request         $request
     *
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update(ExpenseCategory $category, Request $request): JsonResponse
    {
        try {
            $category->name = $request->input('name');
            $category->is_edible = $request->input('is_edible', false);
            $category->color = $request->input('color');

            $category->saveOrFail();

            return response()->json(['message' => 'Category updated.'], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Remove category.
     *
     * @param  ExpenseCategory $category
     *
     * @return JsonResponse
     */
    public function destroy(ExpenseCategory $category): JsonResponse
    {
        try {
            $category->delete();

            return response()->json(['message' => 'Category deleted.'], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }
}
