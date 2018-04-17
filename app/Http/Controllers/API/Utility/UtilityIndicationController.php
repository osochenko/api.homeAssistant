<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Utility;

use Exception;
use Carbon\Carbon;
use App\Models\UtilityIndication;
use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse};
use App\Transformers\UtilityIndicationTransformer;

class UtilityIndicationController extends Controller
{
    /**
     * UtilityIndicationController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

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
            $receivedDate = Carbon::parse($request->input('date'));
            $receivedTypeId = $request->input('type');

            // TODO: Добавить возможность добавление по дням для вывода истории ввода показаний
            $utilityIndication = UtilityIndication::where('type_id', $receivedTypeId)
                ->whereYear('date', $receivedDate->year)
                ->whereMonth('date', $receivedDate->month)
                ->whereDay('date', $receivedDate->day)
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
     * @param  Request $request
     *
     * @return JsonResponse
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
