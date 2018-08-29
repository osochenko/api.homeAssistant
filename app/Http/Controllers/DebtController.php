<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Exception;
use App\Debt;
use Illuminate\Http\{Request, JsonResponse};
use App\Http\Resources\DebtCollectionResource;

class DebtController extends Controller
{
    /**
     * Display a listing of the debt.
     *
     * @return DebtCollectionResource
     */
    public function index(): DebtCollectionResource
    {
        return new DebtCollectionResource(Debt::all());
    }

    /**
     * Store a new debt.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     * @throws \Throwable
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $debt = new Debt();

            $debt->user_id = auth()->user()->id;
            $debt->currency_id = $request->currency;
            $debt->is_your = $request->input('is_your', false);
            $debt->name = $request->name;
            $debt->amount = $request->amount;

            if ($request->has('description')) {
                $debt->description = $request->description;
            }

            $debt->saveOrFail();

            return response()->json(['id' => $debt->id, 'message' => 'Debt created.'], 201);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Update debt.
     *
     * @param  Debt    $debt
     * @param  Request $request
     *
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update(Debt $debt, Request $request): JsonResponse
    {
        try {
            $debt->currency_id = $request->currency;
            $debt->is_your = $request->input('is_your', false);
            $debt->name = $request->name;
            $debt->amount = $request->amount;

            if ($request->has('description')) {
                $debt->description = $request->description;
            }

            $debt->saveOrFail();

            return response()->json(['message' => 'Debt updated.'], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Remove debt.
     *
     * @param  Debt $debt
     *
     * @return JsonResponse
     */
    public function destroy(Debt $debt): JsonResponse
    {
        try {
            $debt->delete();

            return response()->json(['message' => 'Debt deleted.'], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }
}
