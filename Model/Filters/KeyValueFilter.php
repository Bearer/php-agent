<?php

namespace Bearer\Model\Filters;

use Bearer\Model\RegularExpression;
use Bearer\Model\ReportLog;

/**
 * Class KeyValueFilterBase
 * @package Bearer\Model\Filters
 */
abstract class KeyValueFilter extends Filter
{
	/**
	 * @var null|RegularExpression
	 */
	private $valuePattern;

	/**
	 * @var null|RegularExpression
	 */
	private $keyPattern;

	/**
	 * @param ReportLog $log
	 * @return bool
	 */
	public function match($log)
	{
		$params = $this->getMatchParameters($log);

		foreach ($params as $key => $value) {
			if (
				($this->getKeyPattern() !== null && preg_match(
						sprintf('/%s/%s', $this->getKeyPattern()->getValue(), $this->getKeyPattern()->getFlags()),
						$key
					)
				) ||
				($this->getValuePattern() !== null &&
					preg_match(
						sprintf('/%s/%s', $this->getValuePattern()->getValue(), $this->getValuePattern()->getFlags()),
						$value
					)
				)
			) {
				return true;
			}
		}

		return $this->getValuePattern() === null && $this->getKeyPattern() === null;
	}

	/**
	 * @param ReportLog $log
	 * @return array
	 */
	protected abstract function getMatchParameters($log);

	/**
	 * @return RegularExpression|null
	 */
	public function getKeyPattern()
	{
		return $this->keyPattern;
	}

	/**
	 * @param RegularExpression|null $keyPattern
	 * @return KeyValueFilter
	 */
	public function setKeyPattern($keyPattern)
	{
		$this->keyPattern = $keyPattern;

		return $this;
	}

	/**
	 * @return RegularExpression|null
	 */
	public function getValuePattern()
	{
		return $this->valuePattern;
	}

	/**
	 * @param RegularExpression|null $valuePattern
	 * @return KeyValueFilter
	 */
	public function setValuePattern($valuePattern)
	{
		$this->valuePattern = $valuePattern;

		return $this;
	}
}
