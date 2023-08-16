<?php

use App\Enums\TypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('types', function (Blueprint $table) {
			$table->id();
			$table->enum('type', [TypeEnum::Foodstuff, TypeEnum::Detergents, TypeEnum::MeatProducts]);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('type_models');
	}
};
