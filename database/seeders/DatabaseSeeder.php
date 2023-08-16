<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		User::factory()->create([
			'name' => 'Test User',
		]);

		Type::factory()->create([
			'type' => 'foodstuff',
		]);

		Type::factory()->create([
			'type' => 'detergents',
		]);

		Type::factory()->create([
			'type' => 'meat products',
		]);

		Product::factory()->create();
	}
}
