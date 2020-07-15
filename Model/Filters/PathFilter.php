<?php

namespace Bearer\Model\Filters;

use Bearer\Enum\FilterType;
use Bearer\Model\RegularExpression;
use Bearer\Model\ReportLog;

/**
 * Class PathFilter
 * @package Bearer\Model\Filters
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
			sprintf('/%s/%s', str_replace('/', '\/', $this->getPattern()->getValue()), $this->getPattern()->getFlags()),
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
