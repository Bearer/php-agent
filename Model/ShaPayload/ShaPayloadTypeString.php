<?php

namespace Bearer\Sh\Model\ShaPayload;

use Bearer\Sh\Enum\ShaPayloadType;

/**
 * Class ShaPayloadTypeString
 * @package Bearer\Sh\Model\ShaPayload
 */
class ShaPayloadTypeString extends AbstractShaPayloadType
{
	/**
	 * @param mixed $data
	 * @return int
	 */
	public static function vote($data): int
	{
		return is_string($data) ? 1 : 0;
	}

	/**
	 * @return int
	 */
	public function getType(): int
	{
		return ShaPayloadType::STRING;
	}
}
