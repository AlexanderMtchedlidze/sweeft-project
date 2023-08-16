<?php

namespace App\Helpers;

use Carbon\Carbon;
use InvalidArgumentException;

class DateHelper
{
	public static function convertShelfLifeToCarbon($shelfLifeValue): Carbon
	{
		$matches = [];
		preg_match('/(\d+)\s*(\w+)/', $shelfLifeValue, $matches);

		if (count($matches) !== 3) {
			throw new InvalidArgumentException("Invalid shell life format: $shelfLifeValue");
		}

		$value = intval($matches[1]);
		$unit = strtolower($matches[2]);

        return match ($unit) {
            'day', 'days' => Carbon::now()->addDays($value),
            'month', 'months' => Carbon::now()->addMonths($value),
            'year', 'years' => Carbon::now()->addYears($value),
            default => throw new InvalidArgumentException("Unsupported unit: $unit"),
        };
	}
}
