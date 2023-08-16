<?php

namespace App\Helpers;

use Carbon\Carbon;
use InvalidArgumentException;

class DateHelper
{
	public static function convertShelfLifeToCarbon($shelfLifeValue): Carbon
	{
		$matches = [];
		preg_match_all('/(\d+)\s*(\w+)/', $shelfLifeValue, $matches, PREG_SET_ORDER);

		if (empty($matches)) {
			throw new InvalidArgumentException("Invalid shelf life format: $shelfLifeValue");
		}

		$carbon = Carbon::now();

		foreach ($matches as $match) {
			$value = intval($match[1]);
			$unit = $match[2];

			match ($unit) {
				'day', 'days' => $carbon->addDays($value),
				'month', 'months' => $carbon->addMonths($value),
				'year', 'years' => $carbon->addYears($value),
				default => throw new InvalidArgumentException("Unsupported unit: $unit"),
			};
		}

		return $carbon;
	}
}
