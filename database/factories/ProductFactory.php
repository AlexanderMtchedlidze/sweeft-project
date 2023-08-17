<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'name'               => fake()->name,
			'code'               => 'example-code',
			'type_id'            => 1,
			'manufacturing_date' => now(),
			'shelf_life'         => '1 day 3 months 10 years',
			'user_id'            => 1,
		];
	}
}
