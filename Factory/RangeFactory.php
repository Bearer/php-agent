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
	public function __invoke($data)
	{
		$range = new Range();

		$range->setFrom(isset($data['from']) ? $data['from'] : null);
		$range->setTo(isset($data['to']) ? $data['to'] : null);
		$range->setFromExclusive(isset($data['fromExclusive']) ? $data['fromExclusive'] : false);
		$range->setToExclusive(isset($data['toExclusive']) ? $data['toExclusive'] : false);

		return $range;
	}
}
