<?php

namespace Bearer\Model\ShaPayload;

use Bearer\Enum\ShaPayloadType;

/**
 * Class ShaPayloadTypeNull
 * @package Bearer\Model\ShaPayload
 */
class ShaPayloadTypeNull extends AbstractShaPayloadType
{
	/**
	 * @param mixed $data
	 * @return int
	 */
	public static function vote($data)
	{
		return $data === null ? 1 : 0;
	}

	/**
	 * @return int
	 */
	public function getType()
	{
		return ShaPayloadType::NULL;
	}
}
