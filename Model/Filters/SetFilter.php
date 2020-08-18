<?php

namespace Bearer\Model\Filters;

use Bearer\Enum\FilterSetOperator;
use Bearer\Enum\FilterType;
use Bearer\Model\Configuration;
use Bearer\Model\ReportLog;

/**
 * Class SetFilter
 */
class SetFilter extends Filter
{

	/**
	 * @var string
	 */
	protected $typeName = FilterType::FILTER_SET;

	/**
	 * @var string
	 */
	private $operator;

	/**
	 * @var string[]
	 */
	private $childHashes = [];

	/**
	 * @return string
	 */
	public function getOperator()
	{
		return $this->operator;
	}

	/**
	 * @param string $operator
	 * @return SetFilter
	 */
	public function setOperator($operator)
	{
		$this->operator = $operator;
		return $this;
	}

	/**
	 * @param string $hash
	 * @return $this
	 */
	public function addChildHash($hash)
	{
		$this->childHashes[] = $hash;

		return $this;
	}

	/**
	 * @param ReportLog $log
	 * @return bool
	 */
	public function match($log)
	{
		$v1 = $this->getChildHashes() !== null ? $this->getChildHashes() : [];

		$filters = array_combine($v1, array_map(function ($hash) {
				return Configuration::get()->getFilter($hash);
			}, $v1)
		);

		$filters = array_combine(
			array_unique($v1),
			array_map(function (Filter $filter) use($log) {
				return $filter->match($log);
			}, $filters)
		);

		$filters = array_filter(is_array($filters) ? $filters : []);
		if($this->getOperator() === FilterSetOperator::ALL) {
			return count(is_array($filters) ? $filters : []) === count($v1);
		}

		return count(is_array($filters) ? $filters : []) > 0;
	}

	/**
	 * @return string[]
	 */
	public function getChildHashes()
	{
		return $this->childHashes;
	}

	/**
	 * @param string[] $childHashes
	 * @return SetFilter
	 */
	public function setChildHashes($childHashes)
	{
		$this->childHashes = $childHashes;

		return $this;
	}
}
