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
	public static abstract function vote($data);

	/**
	 * @return int
	 */
	public abstract function getType();

	/**
	 * @return array
	 */
	public function getItems()
	{
		return $this->items;
	}

	/**
	 * @param array $items
	 * @return ShaPayload
	 */
	public function setItems($items)
	{
		$this->items = $items;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getRules()
	{
		return $this->rules;
	}

	/**
	 * @param array $rules
	 * @return ShaPayload
	 */
	public function setRules($rules)
	{
		$this->rules = $rules;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getFields()
	{
		return $this->fields;
	}

	/**
	 * @param array $fields
	 * @return ShaPayload
	 */
	public function setFields($fields)
	{
		$this->fields = $fields;
		return $this;
	}
}
