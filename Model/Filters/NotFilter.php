<?php

namespace Bearer\Sh\Model\Filters;

use Bearer\Sh\Enum\FilterType;
use Bearer\Sh\Model\Configuration;
use Bearer\Sh\Model\ReportLog;

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
	public function getChildHash(): string
	{
		return $this->childHash;
	}

	/**
	 * @param string $childHash
	 * @return NotFilter
	 */
	public function setChildHash(string $childHash): NotFilter
	{
		$this->childHash = $childHash;

		return $this;
	}

	/**
	 * @param ReportLog $log
	 * @return bool
	 */
	public function match(ReportLog $log): bool
	{
		$filter = Configuration::get()->getFilter($this->getChildHash());

		if($filter === null) {
			return false;
		}

		return !$filter->match($log);
	}
}
