<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
	public function store(StoreProductRequest $request): JsonResponse
	{
		$attributes = $request->validated();

		Product::create($attributes);

		return response()->json([
			'message' => 'Product created successfully',
		]);
	}

	public function update(Product $product, UpdateProductRequest $request): JsonResponse
	{
		$attributes = $request->validated();

		$product->update($attributes);

		return response()->json([
			'message' => 'Product updated successfully',
		]);
	}

	public function checkShelfLife(Product $product): JsonResponse
	{
		$shellLife = $product->shell_life;

		return response()->json([
			'expired' => $shellLife > now(),
		]);
	}

	public function getQuantityAndType(Product $product): JsonResponse
	{
		return response()->json([
			'quantity' => $product->quantity,
			'type'     => $product->type->type,
		]);
	}
}
