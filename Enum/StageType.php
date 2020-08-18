<?php

namespace Bearer\Enum;

/**
 * Class StageType
 */
class StageType extends Enum
{
	const CONNECT = 'ConnectStage';
	const INIT = 'InitRequestStage';
	const REQUEST = 'RequestStage';
	const RESPONSE = 'ResponseStage';
	const BODIES = 'BodiesStage';

	/**
	 * @param string $stage
	 * @param string $needed
	 * @return bool
	 */
	public static function is($stage, $needed)
	{
		$stages = [self::CONNECT, self::INIT, self::REQUEST, self::RESPONSE, self::BODIES];

		return array_search($needed, $stages, true) >= array_search($stage, $stages, true);
	}
}
