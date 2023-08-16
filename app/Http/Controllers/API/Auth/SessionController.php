<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Session\StoreSessionRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
	public function login(StoreSessionRequest $request)
	{
		$attributes = $request->validated();

		$user = User::where('email', $attributes['username'])->first();

		if (!$user || !Hash::check($attributes['password'], $user->password)) {
			$errorMessage = [
				'username' => [
					'The credentials you entered are incorrect',
				],
			];

			throw ValidationException::withMessages($errorMessage);
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
