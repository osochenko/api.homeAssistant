<?php

declare(strict_types=1);

namespace App\Http\Controllers\AllocatedMoney;

use Exception;
use App\AllocatedMoney;
use App\Http\Controllers\Controller;
use App\Http\Resources\AllocatedMoneyResource;
use Illuminate\Http\{
    Request, JsonResponse
};
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AllocatedMoneyController extends Controller
{
    /**
     * Display a listing of the allocatedMoney.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return AllocatedMoneyResource::collection(AllocatedMoney::all());
    }

    /**
     * Store a new Allocated Money.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $allocatedMoney = new AllocatedMoney();

            $allocatedMoney->user_id = auth()->user()->id;
            $allocatedMoney->type_id = $request->input('type');
            $allocatedMoney->currency_id = $request->input('currency');
            $allocatedMoney->amount = $request->input('amount');

            if ($request->has('description')) {
                $allocatedMoney->description = $request->input('description');
            }

            $allocatedMoney->saveOrFail();

            return response()->json(['allocatedMoney' => fractal($allocatedMoney, new AllocatedMoneyTransformer())], 201);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Update Allocated Money.
     *
     * @param  AllocatedMoney $allocatedMoney
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function update(AllocatedMoney $allocatedMoney, Request $request): JsonResponse
    {
        try {
            $allocatedMoney->type_id = $request->input('type');
            $allocatedMoney->currency_id = $request->input('currency');
            $allocatedMoney->amount = $request->input('amount');

            if ($request->has('description')) {
                $allocatedMoney->description = $request->input('description');
            }

            $allocatedMoney->saveOrFail();

            return response()->json([], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Remove Allocated Money.
     *
     * @param  AllocatedMoney $allocatedMoney
     *
     * @return JsonResponse
     */
    public function destroy(AllocatedMoney $allocatedMoney): JsonResponse
    {
        try {
            $allocatedMoney->delete();

            return response()->json([], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }
}
