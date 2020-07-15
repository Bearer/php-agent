<?php

namespace Bearer\Factory;

use Bearer\Model\Range;

/**
 * Class RangeFactory
 * @package Bearer\Factory
 */
class RangeFactory
{
	/**
	 * @param array $data
	 * @return Range
	 */
	public function __invoke(array $data): Range
	{
		$range = new Range();

		$range->setFrom($data['from'] ?? null);
		$range->setTo($data['to'] ?? null);
		$range->setFromExclusive($data['fromExclusive'] ?? false);
		$range->setToExclusive($data['toExclusive'] ?? false);

		return $range;
	}
}
