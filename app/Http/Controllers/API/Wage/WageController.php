<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Wage;

use Exception;
use App\Models\Wage;
use App\Http\Controllers\Controller;
use App\Transformers\WageTransformer;
use Illuminate\Http\{Request, JsonResponse};

class WageController extends Controller
{
    /**
     * Display a listing of the wage.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(fractal(auth()->user()->wages, new WageTransformer()));
    }

    /**
     * Store a new wage.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $wage = new Wage();

            $wage->user_id = auth()->user()->id;
            $wage->currency_id = $request->input('currency');
            $wage->amount = $request->input('amount');

            $wage->saveOrFail();

            return response()->json(['wage' => fractal($wage, new WageTransformer())], 201);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Update wage.
     *
     * @param  Wage $wage
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function update(Wage $wage, Request $request): JsonResponse
    {
        try {
            $wage->currency_id = $request->input('currency');
            $wage->amount = $request->input('amount');

            $wage->saveOrFail();

            return response()->json([], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Remove wage.
     *
     * @param  Wage $wage
     *
     * @return JsonResponse
     */
    public function destroy(Wage $wage): JsonResponse
    {
        try {
            $wage->delete();

            return response()->json([], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }
}
