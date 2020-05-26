<?php

namespace Bearer\Sh\Model\ShaPayload;

use Bearer\Sh\Enum\ShaPayloadType;

/**
 * Class ShaPayloadTypeObject
 * @package Bearer\Sh\Model\ShaPayload
 */
class ShaPayloadTypeObject extends AbstractShaPayloadType
{
	/**
	 * @param mixed $data
	 * @return int
	 */
	public static function vote($data): int
	{
		if (is_object($data)) {
			return 1;
		}
		if (!is_array($data) || empty($data)) {
			return 0;
		}

		return array_keys($data) !== range(0, count($data) - 1) ? 2 : 0;
	}

	/**
	 * @return int
	 */
	public function getType(): int
	{
		return ShaPayloadType::OBJECT;
	}

}
