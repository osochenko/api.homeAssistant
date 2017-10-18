<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Expense;

use Exception;
use App\Models\TypeExpense;
use App\Http\Controllers\Controller;
use App\Transformers\TypeExpenseTransformer;
use Illuminate\Http\{Request, JsonResponse};

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
     * Display a listing of the typeExpense.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(fractal(auth()->user()->typeExpenses, new TypeExpenseTransformer()));
    }

    /**
     * Store a new typeExpense.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $typeExpense = new TypeExpense();

            $typeExpense->user_id = auth()->user()->id;
            $typeExpense->mandatory = $request->input('mandatory');
            $typeExpense->name = $request->input('name');

            if ($request->has('description')) {
                $typeExpense->description = $request->input('description');
            }
            if ($request->has('color')) {
                $typeExpense->color = $request->input('color');
            }

            $typeExpense->saveOrFail();

            return response()->json(['id' => $typeExpense->id], 201);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Update typeExpense.
     *
     * @param  TypeExpense $typeExpense
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function update(TypeExpense $typeExpense, Request $request): JsonResponse
    {
        try {
            $typeExpense->mandatory = $request->input('mandatory');
            $typeExpense->name = $request->input('name');

            if ($request->has('description')) {
                $typeExpense->description = $request->input('description');
            }
            if ($request->has('color')) {
                $typeExpense->color = $request->input('color');
            }

            $typeExpense->saveOrFail();

            return response()->json([], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Remove typeExpense.
     *
     * @param  TypeExpense $typeExpense
     *
     * @return JsonResponse
     */
    public function destroy(TypeExpense $typeExpense): JsonResponse
    {
        try {
            $typeExpense->delete();

            return response()->json([], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }
}
