<?php

namespace Bearer\Serializer;

use Bearer\Model\ShaPayload\AbstractShaPayloadType;
use Bearer\Model\ShaPayload\ShaPayload;
use Bearer\Model\ShaPayload\ShaPayloadObjectKey;

/**
 * Class ShaPayloadSerializer
 * @package Bearer\Serializer
 */
class ShaPayloadSerializer
{
	/**
	 * @param ShaPayload|null $data
	 * @param bool $hash
	 * @return array|string|null
	 */
	public function __invoke($data, $hash = true)
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

		return $hash ? hash('sha256', json_encode($payload)) : $payload;
	}
}
