<?php

namespace Bearer\Sh\Model\Filters;

use Bearer\Sh\Enum\FilterType;
use Bearer\Sh\Model\RegularExpression;
use Bearer\Sh\Model\ReportLog;

/**
 * Class PathFilter
 * @package Bearer\Sh\Model\Filters
 */
class PathFilter extends Filter
{
    /**
     * @var string
     */
    protected $typeName = FilterType::PATH;

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
			$log->getPath()
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
	 * @return PathFilter
	 */
	public function setPattern(RegularExpression $pattern): PathFilter
	{
		$this->pattern = $pattern;

		return $this;
	}
}
