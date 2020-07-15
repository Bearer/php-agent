<?php

namespace Bearer\Factory;


use Bearer\Model\ShaPayload\AbstractShaPayloadType;
use Bearer\Model\ShaPayload\ShaPayloadObjectKey;
use Bearer\Model\ShaPayload\ShaPayloadTypeArray;
use Bearer\Model\ShaPayload\ShaPayloadTypeBoolean;
use Bearer\Model\ShaPayload\ShaPayloadTypeNull;
use Bearer\Model\ShaPayload\ShaPayloadTypeNumber;
use Bearer\Model\ShaPayload\ShaPayloadTypeObject;
use Bearer\Model\ShaPayload\ShaPayloadTypeString;
use Bearer\Serializer\ShaPayloadSerializer;

/**
 * Class ShaPayloadFactory
 * @package Bearer\Factory
 */
class ShaPayloadFactory
{
	/**
	 * @var array
	 */
	private const type_mapping = [
		ShaPayloadTypeArray::class,
		ShaPayloadTypeBoolean::class,
		ShaPayloadTypeNull::class,
		ShaPayloadTypeNumber::class,
		ShaPayloadTypeObject::class,
		ShaPayloadTypeString::class
	];

	/**
	 * @param $data
	 * @return array|string|null
	 */
	public function __invoke($data)
	{
		$data = json_decode($data);
		if (json_last_error() !== JSON_ERROR_NONE || is_string($data)) {
			return null;
		}
		return (new ShaPayloadSerializer())($this->build($data));
	}

	/**
	 * @param mixed $data
	 * @return AbstractShaPayloadType
	 */
	private function build($data): AbstractShaPayloadType
	{
		$type = $this->findType($data);

		/** @var AbstractShaPayloadType $object */
		$object = new $type();

		if ($object instanceof ShaPayloadTypeArray) {
			$object->setItems(array_map(function ($sub_data) {
				return $this->build($sub_data);
			}, $data));
		}

		if ($object instanceof ShaPayloadTypeObject) {
			if (is_object($data)) {
				$data = json_decode(json_encode($data), true);
			}
			ksort($data);
			$object->setFields(
				array_map(function ($key, $value) {
					return (new ShaPayloadObjectKey())
						->setKey($key)
						->setHash($this->build($value));
				}, array_keys($data), $data)
			);
		}
		return $object;
	}

	/**
	 * @param $data
	 * @return string
	 */
	private function findType($data): string
	{
		$types = [];

		/** @var AbstractShaPayloadType|string $class */
		foreach (self::type_mapping as $class) {
			$types[$class] = $class::vote($data);
		}

		arsort($types);
		$types = array_keys($types);

		return reset($types);
	}
}
