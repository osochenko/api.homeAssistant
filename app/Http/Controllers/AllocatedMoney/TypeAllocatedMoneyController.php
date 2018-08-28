<?php

declare(strict_types=1);

namespace App\Http\Controllers\AllocatedMoney;

use Exception;
use App\Models\TypeAllocatedMoney;
use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse};
use App\Transformers\TypeAllocatedMoneyTransformer;

class TypeAllocatedMoneyController extends Controller
{
    /**
     * Display a listing of the Type Allocated Money.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(fractal(auth()->user()->typeAllocatedMoneys, new TypeAllocatedMoneyTransformer()));
    }

    /**
     * Store a new Type Allocated Money.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $typeAllocatedMoney = new TypeAllocatedMoney();

            $typeAllocatedMoney->user_id = auth()->user()->id;
            $typeAllocatedMoney->name = $request->input('name');

            if ($request->has('description')) {
                $typeAllocatedMoney->description = $request->input('description');
            }

            $typeAllocatedMoney->saveOrFail();

            return response()->json(['typeAllocatedMoney' => fractal($typeAllocatedMoney, new TypeAllocatedMoneyTransformer())], 201);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Update Type Allocated Money.
     *
     * @param  TypeAllocatedMoney $typeAllocatedMoney
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function update(TypeAllocatedMoney $typeAllocatedMoney, Request $request): JsonResponse
    {
        try {
            $typeAllocatedMoney->name = $request->input('name');

            if ($request->has('description')) {
                $typeAllocatedMoney->description = $request->input('description');
            }

            $typeAllocatedMoney->saveOrFail();

            return response()->json([], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Remove Type Allocated Money.
     *
     * @param  TypeAllocatedMoney $typeAllocatedMoney
     *
     * @return JsonResponse
     */
    public function destroy(TypeAllocatedMoney $typeAllocatedMoney): JsonResponse
    {
        try {
            $typeAllocatedMoney->delete();

            return response()->json([], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }
}
