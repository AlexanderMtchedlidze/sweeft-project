<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'id'                 => $this->id,
			'name'               => $this->name,
			'code'               => $this->code,
			'quantity'           => $this->quantity,
			'type_id'            => $this->type_id,
			'manufacturing_date' => $this->manufacturing_date,
			'shelf_life'         => $this->shelf_life,
			'user_id'            => $this->user_id,
			'type'               => new TypeResource($this->whenLoaded('type')),
		];
	}
}
