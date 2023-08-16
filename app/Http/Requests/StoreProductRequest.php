<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

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
            'name' => ['required', 'string'],
            'code' => ['required', Rule::unique('types', 'code')],
            'quantity' => ['sometimes', 'integer', 'min:0'],
            'type_id' => ['required', Rule::exists('types', 'id')],
            'manufacturing_date' => ['required', 'date'],
            'shelf_life' => ['required', 'string'],
            'user_id' => ['required', Rule::exists('users', 'id')]
        ];
    }
}
