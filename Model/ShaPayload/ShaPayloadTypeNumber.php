<?php

namespace Bearer\Sh\Model\ShaPayload;

use Bearer\Sh\Enum\ShaPayloadType;

/**
 * Class ShaPayloadTypeNumber
 * @package Bearer\Sh\Model\ShaPayload
 */
class ShaPayloadTypeNumber extends AbstractShaPayloadType
{
	/**
	 * @param mixed $data
	 * @return int
	 */
	public static function vote($data): int
	{
		return is_numeric($data) ? 2 : 0;
	}

	/**
	 * @return int
	 */
	public function getType(): int
	{
		return ShaPayloadType::NUMBER;
	}
}
