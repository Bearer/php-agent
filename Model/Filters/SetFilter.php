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
	public function getOperator(): string
	{
		return $this->operator;
	}

	/**
	 * @param string $operator
	 * @return SetFilter
	 */
	public function setOperator(string $operator): SetFilter
	{
		$this->operator = $operator;
		return $this;
	}

	/**
	 * @param string $hash
	 * @return $this
	 */
	public function addChildHash(string $hash): SetFilter
	{
		$this->childHashes[] = $hash;

		return $this;
	}

	/**
	 * @param ReportLog $log
	 * @return bool
	 */
	public function match(ReportLog $log): bool
	{
		$filters = array_combine($this->getChildHashes(), array_map(function ($hash) {
				return Configuration::get()->getFilter($hash);
			}, $this->getChildHashes())
		);

		$filters = array_combine($this->getChildHashes(), array_map(function (Filter $filter) use($log) {
				return $filter->match($log);
			}, $filters)
		);

		if($this->getOperator() === FilterSetOperator::ALL) {
			return !in_array(false, $filters);
		}

		return in_array(false, $filters);
	}

	/**
	 * @return string[]
	 */
	public function getChildHashes(): array
	{
		return $this->childHashes;
	}

	/**
	 * @param string[] $childHashes
	 * @return SetFilter
	 */
	public function setChildHashes(array $childHashes): SetFilter
	{
		$this->childHashes = $childHashes;

		return $this;
	}
}
