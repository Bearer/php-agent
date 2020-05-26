<?php

namespace Bearer\Sh\Factory;

use Bearer\Sh\Model\Range;

/**
 * Class RangeFactory
 * @package Bearer\Sh\Factory
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

		$range->setFrom($data['from']);
		$range->setTo($data['to']);
		$range->setFromExclusive($data['fromExclusive'] ?? false);
		$range->setToExclusive($data['toExclusive'] ?? false);

		return $range;
	}
}
