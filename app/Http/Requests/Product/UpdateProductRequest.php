<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'quantity'           => ['integer', 'min:0'],
			'type_id'            => ['integer', Rule::exists('types', 'id')],
			'shelf_life'         => ['string'],
			'manufacturing_date' => ['date'],
		];
	}
}
