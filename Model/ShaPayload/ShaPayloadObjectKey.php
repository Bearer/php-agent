<?php

namespace Bearer\Model\ShaPayload;

/**
 * Class ShaPayloadObjectKey
 * @package Bearer\Model\ShaPayload
 */
class ShaPayloadObjectKey extends ShaPayload
{
	/**
	 * @var AbstractShaPayloadType
	 */
	private $hash;

	/**
	 * @var string
	 */
	private $key;

	/**
	 * @return AbstractShaPayloadType
	 */
	public function getHash()
	{
		return $this->hash;
	}

	/**
	 * @param AbstractShaPayloadType $hash
	 * @return ShaPayloadObjectKey
	 */
	public function setHash($hash)
	{
		$this->hash = $hash;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getKey()
	{
		return $this->key;
	}

	/**
	 * @param string $key
	 * @return ShaPayloadObjectKey
	 */
	public function setKey($key)
	{
		$this->key = $key;
		return $this;
	}
}
