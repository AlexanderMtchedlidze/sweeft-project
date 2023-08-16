<?php

namespace App\Models;

use App\Helpers\DateHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
	use HasFactory;

	public function type(): BelongsTo
	{
		return $this->belongsTo(Type::class);
	}

	public function setShelfLifeAttribute(string $shelfLife): void
	{
		$this->attributes['shelf_life'] = DateHelper::convertShelfLifeToCarbon($shelfLife);
	}
}
