<?php

namespace Bearer\Model\ShaPayload;

use Bearer\Enum\ShaPayloadType;

/**
 * Class ShaPayloadTypeArray
 * @package Bearer\Model\ShaPayload
 */
class ShaPayloadTypeArray extends AbstractShaPayloadType
{
	/**
	 * @param mixed $data
	 * @return int
	 */
	public static function vote($data): int
	{
		return is_array($data) ? 1 : 0;
	}

	/**
	 * @return int
	 */
	public function getType(): int
	{
		return ShaPayloadType::ARRAY;
	}

}
