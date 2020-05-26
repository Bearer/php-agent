<?php

namespace Bearer\Sh\Model\ShaPayload;

use Bearer\Sh\Enum\ShaPayloadType;

/**
 * Class ShaPayloadTypeNull
 * @package Bearer\Sh\Model\ShaPayload
 */
class ShaPayloadTypeNull extends AbstractShaPayloadType
{
	/**
	 * @param mixed $data
	 * @return int
	 */
	public static function vote($data): int
	{
		return $data === null ? 1 : 0;
	}

	/**
	 * @return int
	 */
	public function getType(): int
	{
		return ShaPayloadType::NULL;
	}
}
