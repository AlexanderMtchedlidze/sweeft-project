<?php

namespace App\Http\Controllers\API\Product;

use App\Helpers\DateHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ProductController extends Controller
{
	public function store(StoreProductRequest $request): JsonResponse
	{
        $validatedData = $request->validated();

        $carbonShellLife = DateHelper::convertShelfLifeToCarbon($validatedData['shelf_life']);

        $validatedData['shelf_life'] = $carbonShellLife;

        Product::create($validatedData);

        return response()->json([
            'message' => 'Product created successfully',
        ], ResponseAlias::HTTP_CREATED);
	}

	public function update(Product $product, UpdateProductRequest $request): JsonResponse
	{
		$product->update($request->validated());

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
			'type'     => $product->type->name,
		]);
	}
}
