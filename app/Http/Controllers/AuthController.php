<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Hash;
use App\Models\User;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @param UserCreateRequest $request
     *
     * @return JsonResponse
     * @throws \Throwable
     */
    public function register(UserCreateRequest $request): JsonResponse
    {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->saveOrFail();

        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return UserResource
     */
    public function user(): UserResource
    {
        return new UserResource(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token): JsonResponse
    {
        $tokenTTL = auth()->factory()->getTTL();
        $tokenExpiresIn = now()->addMinute($tokenTTL);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $tokenExpiresIn->timestamp,
        ]);
    }
}