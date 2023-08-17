<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use InvalidArgumentException;

class Product extends Model
{
	use HasFactory;

	public function type(): BelongsTo
	{
		return $this->belongsTo(Type::class);
	}

    public function setShelfLifeAttribute($value): void
    {
        self::calculateExpiryDate(Carbon::parse($this->manufacturing_date), $value);
        $this->attributes['shelf_life'] = $value;
    }

	public function checkShelfLifeExpiration(): bool
    {
		$manufacturingDate = Carbon::parse($this->manufacturing_date);

		$expiryDate = self::calculateExpiryDate($manufacturingDate, $this->shelf_life);

		return $expiryDate->isPast();
	}

	public static function calculateExpiryDate(Carbon $manufacturingDate, string $shelfLifeValue): Carbon
	{
		$matches = self::parseShelfLifeValue($shelfLifeValue);
		$expiryDate = $manufacturingDate->copy();

		foreach ($matches as $match) {
			$value = intval($match[1]);
			$unit = $match[2];

			match ($unit) {
				'day', 'days' => $expiryDate->addDays($value),
				'month', 'months' => $expiryDate->addMonths($value),
				'year', 'years' => $expiryDate->addYears($value),
				default => throw new InvalidArgumentException('Invalid shelf life format')
			};
		}

		return $expiryDate;
	}

	protected static function parseShelfLifeValue(string $shelfLifeValue): array
	{
		$matches = [];
		preg_match_all('/(\d+)\s*(\w+)/', $shelfLifeValue, $matches, PREG_SET_ORDER);

		if (empty($matches)) {
			throw new InvalidArgumentException("Invalid shelf life format: $shelfLifeValue");
		}

		return $matches;
	}
}
