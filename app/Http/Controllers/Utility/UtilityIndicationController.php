<?php

declare(strict_types=1);

namespace App\Http\Controllers\Utility;

use App\Http\Resources\UtilityIndicationCollectionResource;
use Exception;
use Carbon\Carbon;
use App\UtilityIndication;
use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse};

class UtilityIndicationController extends Controller
{
    /**
     * Display a listing of the Utility Indication.
     *
     * @return UtilityIndicationCollectionResource
     */
    public function index(): UtilityIndicationCollectionResource
    {
        return new UtilityIndicationCollectionResource(auth()->user()->utilityIndications);
    }

    /**
     * Store a new Utility Indication.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     * @throws \Throwable
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $receivedDate = Carbon::parse($request->input('date'));
            $receivedTypeId = $request->input('type');

            $utilityIndication = UtilityIndication::query()->where('type_id', $receivedTypeId)
                ->whereYear('date', $receivedDate->year)
                ->whereMonth('date', $receivedDate->month)
                ->first();

            if (!$utilityIndication) {
                $utilityIndication = new UtilityIndication();
                $utilityIndication->user_id = auth()->user()->id;
                $utilityIndication->type_id = $receivedTypeId;
            }

            $utilityIndication->amount = $request->input('amount');
            $utilityIndication->date = $receivedDate;

            $utilityIndication->saveOrFail();

            return response()->json(['id' => $utilityIndication->id], 201);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Update Utility Indication.
     *
     * @param  UtilityIndication $utilityIndication
     * @param  Request           $request
     *
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update(UtilityIndication $utilityIndication, Request $request): JsonResponse
    {
        try {
            $utilityIndication->type_id = $request->input('type');
            $utilityIndication->amount = $request->input('amount');
            $utilityIndication->date = Carbon::parse($request->input('date'));

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
