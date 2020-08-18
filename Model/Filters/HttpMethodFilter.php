<?php

namespace Bearer\Model\Filters;

use Bearer\Enum\FilterType;
use Bearer\Model\ReportLog;

/**
 * Class HttpMethodFilter
 */
class HttpMethodFilter extends Filter
{
    /**
     * @var string
     */
    protected $typeName = FilterType::HTTP_METHOD;

	/**
	 * @var string
	 */
	private $value;

	/**
	 * @param ReportLog $log
	 * @return bool
	 */
	public function match($log)
	{
		return $log->getMethod() === $this->getValue();
	}

	/**
	 * @return string
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @param string $value
	 * @return HttpMethodFilter
	 */
	public function setValue($value)
	{
		$this->value = $value;

		return $this;
	}
}
