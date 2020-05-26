<?php

namespace Bearer\Sh\Model\Filters;

use Bearer\Sh\Enum\FilterType;
use Bearer\Sh\Model\ReportLog;

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
	public function match(ReportLog $log): bool
	{
		return $log->getMethod() === $this->getValue();
	}

	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}

	/**
	 * @param string $value
	 * @return HttpMethodFilter
	 */
	public function setValue(string $value): HttpMethodFilter
	{
		$this->value = $value;

		return $this;
	}
}
