<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Debt;
use App\Http\Controllers\Controller;
use App\Transformers\DebtTransformer;
use Illuminate\Http\{Request, JsonResponse};

class DebtController extends Controller
{
    /**
     * DebtController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the debt.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(fractal(auth()->user()->debts, new DebtTransformer()));
    }

    /**
     * Store a new debt.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $debt = new Debt();

            $debt->user_id = auth()->user()->id;
            $debt->currency_id = $request->input('currency');
            $debt->name = $request->input('name');
            $debt->amount = $request->input('amount');

            if ($request->input('description')) {
                $debt->description = $request->input('description');
            }

            $debt->saveOrFail();

            return response()->json(['id' => $debt->id], 201);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }
    
    /**
     * Update debt.
     *
     * @param  Debt $debt
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function update(Debt $debt, Request $request): JsonResponse
    {
        try {
            $debt->currency_id = $request->input('currency');
            $debt->name = $request->input('name');
            $debt->amount = $request->input('amount');

            if ($request->input('description')) {
                $debt->description = $request->input('description');
            }

            $debt->saveOrFail();

            return response()->json([], 204);
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

            return response()->json([], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }
}
