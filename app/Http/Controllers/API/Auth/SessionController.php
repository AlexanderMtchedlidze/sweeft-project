<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Session\StoreSessionRequest;
use Illuminate\Http\JsonResponse;

class SessionController extends Controller
{
	public function login(StoreSessionRequest $request): JsonResponse
	{
		$attributes = $request->validated();

		if (auth()->attempt($attributes)) {
			session()->regenerate();

			$token = auth()->user()->createToken('api-token')->plainTextToken;

			return response()->json([
				'message' => 'Logged in successfully',
				'token'   => $token,
			]);
		}

		return response()->json([
			'message' => 'The credentials you entered are incorrect',
		]);
	}
}
