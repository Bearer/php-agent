<?php

namespace Bearer\Model\ShaPayload;

use Bearer\Enum\ShaPayloadType;

/**
 * Class ShaPayloadTypeBoolean
 * @package Bearer\Model\ShaPayload
 */
class ShaPayloadTypeBoolean extends AbstractShaPayloadType
{
	/**
	 * @param mixed $data
	 * @return int
	 */
	public static function vote($data): int
	{
		return is_bool($data) ? 1 : 0;
	}

	/**
	 * @return int
	 */
	public function getType(): int
	{
		return ShaPayloadType::BOOLEAN;
	}

}
