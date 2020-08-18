<?php

namespace Bearer\Model\Filters;

use Bearer\Enum\FilterType;
use Bearer\Model\RegularExpression;
use Bearer\Model\ReportLog;

/**
 * Class DomainFilter
 */
class DomainFilter extends Filter
{
	/**
	 * @var string
	 */
	protected $typeName = FilterType::DOMAIN;

	/**
	 * @var RegularExpression
	 */
	private $pattern;

	/**
	 * @param ReportLog $log
	 * @return bool
	 */
	public function match($log)
	{
		return (bool)preg_match(
			sprintf('/%s/%s', $this->getPattern()->getValue(), $this->getPattern()->getFlags()),
			$log->getHostname()
		);
	}

	/**
	 * @return RegularExpression
	 */
	public function getPattern()
	{
		return $this->pattern;
	}

	/**
	 * @param RegularExpression $pattern
	 * @return DomainFilter
	 */
	public function setPattern($pattern)
	{
		$this->pattern = $pattern;

		return $this;
	}
}
