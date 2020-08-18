<?php

namespace Bearer\Model\Filters;

use Bearer\Enum\FilterType;
use Bearer\Model\ReportLog;

/**
 * Class Filter
 */
abstract class Filter
{

	/**
	 * @var string
	 */
	protected $typeName;

	/**
	 * @return string
	 */
	public function getTypeName()
	{
		return $this->typeName;
	}

	/**
	 * @param ReportLog $log
	 * @return bool
	 */
	public abstract function match($log);
}
