<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'name'               => ['required', 'string', 'min:10', 'max:15'],
			'code'               => ['required', Rule::unique('types', 'code')],
			'quantity'           => ['integer', 'min:0'],
			'type_id'            => ['required', Rule::exists('types', 'id')],
			'manufacturing_date' => ['required', 'date'],
			'shelf_life'         => ['required', 'string'],
			'user_id'            => ['required', Rule::exists('users', 'id')],
		];
	}
}
