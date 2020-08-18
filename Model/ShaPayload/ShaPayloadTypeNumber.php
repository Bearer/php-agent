<?php

namespace Bearer\Model\ShaPayload;

use Bearer\Enum\ShaPayloadType;

/**
 * Class ShaPayloadTypeNumber
 * @package Bearer\Model\ShaPayload
 */
class ShaPayloadTypeNumber extends AbstractShaPayloadType
{
	/**
	 * @param mixed $data
	 * @return int
	 */
	public static function vote($data)
	{
		return is_integer($data) ? 2 : 0;
	}

	/**
	 * @return int
	 */
	public function getType()
	{
		return ShaPayloadType::NUMBER;
	}
}
