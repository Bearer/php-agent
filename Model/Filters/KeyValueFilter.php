<?php

namespace Bearer\Sh\Model\Filters;

use Bearer\Sh\Model\RegularExpression;
use Bearer\Sh\Model\ReportLog;

/**
 * Class KeyValueFilterBase
 * @package Bearer\Sh\Model\Filters
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
	public function match(ReportLog $log): bool
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

		return false;
	}

	/**
	 * @param ReportLog $log
	 * @return array
	 */
	protected abstract function getMatchParameters(ReportLog $log): array;

	/**
	 * @return RegularExpression|null
	 */
	public function getKeyPattern(): ?RegularExpression
	{
		return $this->keyPattern;
	}

	/**
	 * @param RegularExpression|null $keyPattern
	 * @return KeyValueFilter
	 */
	public function setKeyPattern(?RegularExpression $keyPattern): KeyValueFilter
	{
		$this->keyPattern = $keyPattern;

		return $this;
	}

	/**
	 * @return RegularExpression|null
	 */
	public function getValuePattern(): ?RegularExpression
	{
		return $this->valuePattern;
	}

	/**
	 * @param RegularExpression|null $valuePattern
	 * @return KeyValueFilter
	 */
	public function setValuePattern(?RegularExpression $valuePattern): KeyValueFilter
	{
		$this->valuePattern = $valuePattern;

		return $this;
	}
}
