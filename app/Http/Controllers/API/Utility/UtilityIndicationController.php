<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Utility;

use Exception;
use App\Models\UtilityIndication;
use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse};
use App\Transformers\UtilityIndicationTransformer;

class UtilityIndicationController extends Controller
{
    /**
     * Display a listing of the Utility Indication.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(fractal(auth()->user()->utilityIndications, new UtilityIndicationTransformer()));
    }

    /**
     * Store a new Utility Indication.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $utilityIndication = new UtilityIndication();

            $utilityIndication->user_id = auth()->user()->id;
            $utilityIndication->type_id = $request->input('type');
            $utilityIndication->amount = $request->input('amount');

            if ($request->has('description')) {
                $utilityIndication->description = $request->input('description');
            }

            $utilityIndication->saveOrFail();

            return response()->json(['utilityIndication' => fractal($utilityIndication, new UtilityIndicationTransformer())], 201);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Update Utility Indication.
     *
     * @param  UtilityIndication $utilityIndication
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function update(UtilityIndication $utilityIndication, Request $request): JsonResponse
    {
        try {
            $utilityIndication->type_id = $request->input('type');
            $utilityIndication->amount = $request->input('amount');

            if ($request->has('description')) {
                $utilityIndication->description = $request->input('description');
            }

            $utilityIndication->saveOrFail();

            return response()->json([], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Remove Utility Indication.
     *
     * @param  UtilityIndication $utilityIndication
     *
     * @return JsonResponse
     */
    public function destroy(UtilityIndication $utilityIndication): JsonResponse
    {
        try {
            $utilityIndication->delete();

            return response()->json([], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }
}
