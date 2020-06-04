<?php

namespace Bearer\Model\ShaPayload;

/**
 * Class AbstractShaPayloadType
 * @package Bearer\Model\ShaPayload
 */
abstract class AbstractShaPayloadType extends ShaPayload
{
	/**
	 * @var array
	 */
	private $items = [];

	/**
	 * @var array
	 */
	private $rules = [];

	/**
	 * @var array
	 */
	private $fields = [];

	/**
	 * @param mixed $data
	 * @return int
	 */
	public static abstract function vote($data): int;

	/**
	 * @return int
	 */
	public abstract function getType(): int;

	/**
	 * @return array
	 */
	public function getItems(): array
	{
		return $this->items;
	}

	/**
	 * @param array $items
	 * @return ShaPayload
	 */
	public function setItems(array $items): ShaPayload
	{
		$this->items = $items;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getRules(): array
	{
		return $this->rules;
	}

	/**
	 * @param array $rules
	 * @return ShaPayload
	 */
	public function setRules(array $rules): ShaPayload
	{
		$this->rules = $rules;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getFields(): array
	{
		return $this->fields;
	}

	/**
	 * @param array $fields
	 * @return ShaPayload
	 */
	public function setFields(array $fields): ShaPayload
	{
		$this->fields = $fields;
		return $this;
	}
}
