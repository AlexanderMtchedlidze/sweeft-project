<?php

namespace App\Models;

use App\Enums\TypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
	use HasFactory;

	protected $casts = [
		'type' => TypeEnum::class,
	];
}
