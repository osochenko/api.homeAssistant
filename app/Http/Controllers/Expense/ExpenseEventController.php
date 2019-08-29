<?php

declare(strict_types=1);

namespace App\Http\Controllers\Expense;

use Exception;
use App\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\{
    Request, JsonResponse, Resources\Json\AnonymousResourceCollection
};
use App\Http\Resources\ExpenseEventResource;

class ExpenseEventController extends Controller
{
    /**
     * Display a listing of the event.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ExpenseEventResource::collection(Event::all());
    }

    /**
     * Store a new event.
     *
     * @param  Request $request
     *
     * @return JsonResponse
     * @throws \Throwable
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $event = new Event();

            $event->user_id = auth()->user()->id;
            $event->name = $request->input('name');

            $event->saveOrFail();

            return response()->json(['id' => $event->id], 201);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Update event.
     *
     * @param  Event   $event
     * @param  Request $request
     *
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update(Event $event, Request $request): JsonResponse
    {
        try {
            $event->name = $request->input('name');
            $event->is_edible = $request->input('is_edible', false);
            $event->color = $request->input('color');

            $event->saveOrFail();

            return response()->json(['message' => 'Event expense updated.'], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }

    /**
     * Remove event.
     *
     * @param  Event $event
     *
     * @return JsonResponse
     */
    public function destroy(Event $event): JsonResponse
    {
        try {
            $event->delete();

            return response()->json(['message' => 'Event expense deleted.'], 204);
        } catch (Exception $error) {
            return response()->json(['message' => $error->getMessage()], 500);
        }
    }
}
