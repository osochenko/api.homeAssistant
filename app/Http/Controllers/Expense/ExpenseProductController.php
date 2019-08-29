<?php

declare(strict_types=1);

namespace App\Http\Controllers\Expense;

use Exception;
use App\ExpenseProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\{
    Request, JsonResponse, Resources\Json\AnonymousResourceCollection
};
use App\Http\Resources\ExpenseProductResource;

class ExpenseProductController extends Controller
{
    /**
     * Display a listing of the expenseProduct.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ExpenseProductResource::collection(ExpenseProduct::all());
    }

    /**
     * Store a new expenseProduct.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     * @throws \Throwable
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $product = new ExpenseProduct();

            $product->name = $request->input('name');
            $product->category_id = $request->input('category_id');

            $product->saveOrFail();

            return response()->json(['id' => $product->id], 201);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Update expenseProduct.
     *
     * @param  ExpenseProduct $product
     * @param  Request         $request
     *
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update(ExpenseProduct $product, Request $request): JsonResponse
    {
        try {
            $product->name = $request->input('name');
            $product->category_id = $request->input('category_id');

            $product->saveOrFail();

            return response()->json(['message' => 'Expense Product updated.'], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Remove expenseProduct.
     *
     * @param  ExpenseProduct $product
     *
     * @return JsonResponse
     */
    public function destroy(ExpenseProduct $product): JsonResponse
    {
        try {
            $product->delete();

            return response()->json(['message' => 'Expense Product deleted.'], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }
}
