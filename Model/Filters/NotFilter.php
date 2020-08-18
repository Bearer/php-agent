<?php

namespace Bearer\Model\Filters;

use Bearer\Enum\FilterType;
use Bearer\Model\Configuration;
use Bearer\Model\ReportLog;

/**
 * Class NotFilter
 */
class NotFilter extends Filter
{
	/**
	 * @var string
	 */
	protected $typeName = FilterType::NOT;

	/**
	 * @var string
	 */
	private $childHash;

	/**
	 * @return string
	 */
	public function getChildHash()
	{
		return $this->childHash;
	}

	/**
	 * @param string $childHash
	 * @return NotFilter
	 */
	public function setChildHash($childHash)
	{
		$this->childHash = $childHash;

		return $this;
	}

	/**
	 * @param ReportLog $log
	 * @return bool
	 */
	public function match($log)
	{
		$filter = Configuration::get()->getFilter($this->getChildHash());

		if($filter === null) {
			return false;
		}

		return !$filter->match($log);
	}
}
