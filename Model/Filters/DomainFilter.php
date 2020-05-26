<?php

namespace Bearer\Sh\Model\Filters;

use Bearer\Sh\Enum\FilterType;
use Bearer\Sh\Model\RegularExpression;
use Bearer\Sh\Model\ReportLog;

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
	public function match(ReportLog $log): bool
	{
		return (bool)preg_match(
			sprintf('/%s/%s', $this->getPattern()->getValue(), $this->getPattern()->getFlags()),
			$log->getHostname()
		);
	}

	/**
	 * @return RegularExpression
	 */
	public function getPattern(): RegularExpression
	{
		return $this->pattern;
	}

	/**
	 * @param RegularExpression $pattern
	 * @return DomainFilter
	 */
	public function setPattern(RegularExpression $pattern): DomainFilter
	{
		$this->pattern = $pattern;

		return $this;
	}
}
