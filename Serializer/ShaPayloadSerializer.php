<?php

namespace Bearer\Sh\Serializer;

use Bearer\Sh\Model\ShaPayload\AbstractShaPayloadType;
use Bearer\Sh\Model\ShaPayload\ShaPayload;
use Bearer\Sh\Model\ShaPayload\ShaPayloadObjectKey;

/**
 * Class ShaPayloadSerializer
 * @package Bearer\Sh\Serializer
 */
class ShaPayloadSerializer
{
	/**
	 * @param ShaPayload|null $data
	 * @param bool $hash
	 * @return array|string|null
	 */
	public function __invoke(?ShaPayload $data, bool $hash = true)
	{
		if ($data === null) {
			return null;
		}

		$payload = null;

		if ($data instanceof AbstractShaPayloadType) {
			$payload = [
				'fields' => array_map(function ($field) {
					return $this($field, false);
				}, $data->getFields()),
				'items' => array_map(function ($item) {
					return $this($item, false);
				}, $data->getItems()),
				'rules' => [],
				'type' => $data->getType()
			];
		}

		if ($data instanceof ShaPayloadObjectKey) {
			$payload = [
				'hash' => $this($data->getHash(), false),
				'key' => $data->getKey()
			];
		}

		return $hash ? hash('sha256', json_encode($payload, JSON_NUMERIC_CHECK)) : $payload;
	}
}
