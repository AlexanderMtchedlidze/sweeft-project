<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\TypeResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
	public function store(StoreProductRequest $request): JsonResponse
	{
		$attributes = $request->validated();

		$product = Product::create($attributes);

		$product->load('type');

		return response()->json([
			'message' => 'Product created successfully',
			'product' => new ProductResource($product),
		]);
	}

	public function update(Product $product, UpdateProductRequest $request): JsonResponse
	{
		$attributes = $request->validated();

		$product->update($attributes);

		$product->load('type');

		return response()->json([
			'message' => 'Product updated successfully',
			'product' => new ProductResource($product),
		]);
	}

	public function checkShelfLifeExpiration(Product $product): JsonResponse
	{
		return response()->json([
			'expired' => $product->checkShelfLifeExpiration(),
		]);
	}

	public function getQuantityAndType(Product $product): JsonResponse
	{
		return response()->json([
			'quantity' => $product->quantity,
			'type'     => new TypeResource($product->type),
		]);
	}
}
