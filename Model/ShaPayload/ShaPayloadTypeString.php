<?php

namespace Bearer\Model\ShaPayload;

use Bearer\Enum\ShaPayloadType;

/**
 * Class ShaPayloadTypeString
 * @package Bearer\Model\ShaPayload
 */
class ShaPayloadTypeString extends AbstractShaPayloadType
{
	/**
	 * @param mixed $data
	 * @return int
	 */
	public static function vote($data)
	{
		return is_string($data) ? 1 : 0;
	}

	/**
	 * @return int
	 */
	public function getType()
	{
		return ShaPayloadType::STRING;
	}
}
