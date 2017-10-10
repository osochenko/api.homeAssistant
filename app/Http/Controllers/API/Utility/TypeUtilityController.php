<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Utility;

use Exception;
use App\Models\TypeUtility;
use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse};
use App\Transformers\TypeUtilityTransformer;

class TypeUtilityController extends Controller
{
    /**
     * Display a listing of the Type Utility Indication.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(fractal(auth()->user()->typeUtilities, new TypeUtilityTransformer()));
    }

    /**
     * Store a new Type Utility Indication.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $typeUtility = new TypeUtility();

            $typeUtility->user_id = auth()->user()->id;
            $typeUtility->name = $request->input('name');
            $typeUtility->rate = $request->input('rate');

            if ($request->has('description')) {
                $typeUtility->description = $request->input('description');
            }

            $typeUtility->saveOrFail();

            return response()->json(['typeUtility' => fractal($typeUtility, new TypeUtilityTransformer())], 201);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Update Type Utility Indication.
     *
     * @param  TypeUtility $typeUtility
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function update(TypeUtility $typeUtility, Request $request): JsonResponse
    {
        try {
            $typeUtility->name = $request->input('name');
            $typeUtility->rate = $request->input('rate');

            if ($request->has('description')) {
                $typeUtility->description = $request->input('description');
            }

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
