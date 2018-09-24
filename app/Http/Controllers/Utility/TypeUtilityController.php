<?php

declare(strict_types=1);

namespace App\Http\Controllers\Utility;

use Exception;
use App\TypeUtility;
use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse};
use App\Http\Resources\TypeUtilityResource;

class TypeUtilityController extends Controller
{
    /**
     * Display a listing of the Type Utility Indication.
     * @return TypeUtilityResource
     */
    public function index(): TypeUtilityResource
    {
        return new TypeUtilityResource(auth()->user()->typeUtilities);
    }

    /**
     * Store a new Type Utility Indication.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     * @throws \Throwable
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $typeUtility = new TypeUtility();

            $typeUtility->user_id = auth()->user()->id;
            $typeUtility->name = $request->input('name');
            $typeUtility->currency_id = $request->input('currency.id');
            $typeUtility->rate = $request->input('rate');
            $typeUtility->unit = $request->input('unit');

            $typeUtility->saveOrFail();

            return response()->json(['id' => $typeUtility->id], 201);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Update Type Utility Indication.
     *
     * @param  TypeUtility $typeUtility
     * @param  Request     $request
     *
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update(TypeUtility $typeUtility, Request $request): JsonResponse
    {
        try {
            $typeUtility->name = $request->input('name');
            $typeUtility->currency_id = $request->input('currency.id');
            $typeUtility->rate = $request->input('rate');
            $typeUtility->unit = $request->input('unit');

            $typeUtility->saveOrFail();

            return response()->json([], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Remove Type Utility Indication.
     *
     * @param  TypeUtility $typeUtility
     *
     * @return JsonResponse
     */
    public function destroy(TypeUtility $typeUtility): JsonResponse
    {
        try {
            $typeUtility->delete();

            return response()->json([], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }
}
