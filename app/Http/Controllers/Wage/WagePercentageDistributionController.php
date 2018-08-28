<?php

declare(strict_types=1);

namespace App\Http\Controllers\Wage;

use Exception;
use App\Models\WagePercentageDistribution;
use App\Http\Controllers\Controller;
use App\Transformers\WagePercentageDistributionTransformer;
use Illuminate\Http\{Request, JsonResponse};

class WagePercentageDistributionController extends Controller
{
    /**
     * Display a listing of the wagePercentageDistribution.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(fractal(auth()->user()->wagePercentageDistributions, new WagePercentageDistributionTransformer()));
    }

    /**
     * Store a new wagePercentageDistribution.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $wagePercentageDistribution = new WagePercentageDistribution();

            $wagePercentageDistribution->user_id = auth()->user()->id;
            $wagePercentageDistribution->wage_id = $request->input('wage');
            $wagePercentageDistribution->name = $request->input('name');
            $wagePercentageDistribution->percent = $request->input('percent');

            if ($request->has('description')) {
                $wagePercentageDistribution->description = $request->input('description');
            }

            $wagePercentageDistribution->saveOrFail();

            return response()->json(['wagePercentageDistribution' => fractal($wagePercentageDistribution, new WagePercentageDistributionTransformer())], 201);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Update wagePercentageDistribution.
     *
     * @param  WagePercentageDistribution $wagePercentageDistribution
     * @param  Request $request
     *
     * @return JsonResponse
     */
    public function update(WagePercentageDistribution $wagePercentageDistribution, Request $request): JsonResponse
    {
        try {
            $wagePercentageDistribution->wage_id = $request->input('wage');
            $wagePercentageDistribution->name = $request->input('name');
            $wagePercentageDistribution->percent = $request->input('percent');

            if ($request->has('description')) {
                $wagePercentageDistribution->description = $request->input('description');
            }

            $wagePercentageDistribution->saveOrFail();

            return response()->json([], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Remove wagePercentageDistribution.
     *
     * @param  WagePercentageDistribution $wagePercentageDistribution
     *
     * @return JsonResponse
     */
    public function destroy(WagePercentageDistribution $wagePercentageDistribution): JsonResponse
    {
        try {
            $wagePercentageDistribution->delete();

            return response()->json([], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }
}
