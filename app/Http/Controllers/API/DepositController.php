<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Deposit;
use App\Http\Controllers\Controller;
use App\Transformers\DepositTransformer;
use Illuminate\Http\{Request, JsonResponse};

class DepositController extends Controller
{
    /**
     * Display a listing of the deposit.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(fractal(auth()->user()->deposits, new DepositTransformer()));
    }

    /**
     * Store a new deposit.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $deposit = new Deposit();

            $deposit->user_id = auth()->user()->id;
            $deposit->currency_id = $request->input('currency');
            $deposit->name = $request->input('name');
            $deposit->amount = $request->input('amount');

            if ($request->input('description')) {
                $deposit->description = $request->input('description');
            }

            $deposit->saveOrFail();

            return response()->json(['deposit' => fractal($deposit, new DepositTransformer())], 201);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Update deposit.
     *
     * @param  Deposit $deposit
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function update(Deposit $deposit, Request $request): JsonResponse
    {
        try {
            $deposit->currency_id = $request->input('currency');
            $deposit->name = $request->input('name');
            $deposit->amount = $request->input('amount');

            if ($request->input('description')) {
                $deposit->description = $request->input('description');
            }

            $deposit->saveOrFail();

            return response()->json([], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Remove deposit.
     *
     * @param  Deposit $deposit
     *
     * @return JsonResponse
     */
    public function destroy(Deposit $deposit): JsonResponse
    {
        try {
            $deposit->delete();

            return response()->json([], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }
}
