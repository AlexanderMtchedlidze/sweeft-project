<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Session\StoreSessionRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SessionController extends Controller
{
	public function login(StoreSessionRequest $request): JsonResponse
	{
		$attributes = $request->validated();

		$user = User::where('name', $attributes['name'])->first();

		if (!$user || !Hash::check($attributes['password'], $user->password)) {
			return response()->json([
				'message' => 'The credentials you entered are incorrect',
			], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
		}

		auth()->login($user);
		session()->regenerate();

		$token = $user->createToken('api-token')->plainTextToken;

		return response()->json([
			'message' => 'Logged in successfully',
			'token'   => $token,
		]);
	}
}
