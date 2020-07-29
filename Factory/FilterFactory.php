<?php

namespace Bearer\Factory;

use Bearer\Enum\FilterType;
use Bearer\Model\Filters\ConnectionErrorFilter;
use Bearer\Model\Filters\DomainFilter;
use Bearer\Model\Filters\Filter;
use Bearer\Model\Filters\HttpMethodFilter;
use Bearer\Model\Filters\KeyValueFilter;
use Bearer\Model\Filters\NotFilter;
use Bearer\Model\Filters\ParamFilter;
use Bearer\Model\Filters\PathFilter;
use Bearer\Model\Filters\RangeFilter;
use Bearer\Model\Filters\RequestBodyFilter;
use Bearer\Model\Filters\RequestBodySizeFilter;
use Bearer\Model\Filters\RequestHeaderFilter;
use Bearer\Model\Filters\ResponseBodyFilter;
use Bearer\Model\Filters\ResponseBodySizeFilter;
use Bearer\Model\Filters\ResponseHeaderFilter;
use Bearer\Model\Filters\SetFilter;
use Bearer\Model\Filters\StatusCodeFilter;

/**
 * Class FilterFactory
 * @package Bearer\Factory
 */
class FilterFactory
{
	/**
	 * @var array
	 */
	private const mapping = [
		FilterType::NOT => NotFilter::class,
		FilterType::FILTER_SET => SetFilter::class,
		FilterType::DOMAIN => DomainFilter::class,
		FilterType::HTTP_METHOD => HttpMethodFilter::class,
		FilterType::PATH => PathFilter::class,
		FilterType::PARAM => ParamFilter::class,
		FilterType::REQUEST_HEADER => RequestHeaderFilter::class,
		FilterType::RESPONSE_HEADER => ResponseHeaderFilter::class,
		FilterType::STATUS_CODE => StatusCodeFilter::class,
		FilterType::CONNECTION_ERROR => ConnectionErrorFilter::class,
		FilterType::REQUEST_BODY => RequestBodyFilter::class,
		FilterType::REQUEST_BODY_SIZE => RequestBodySizeFilter::class,
		FilterType::RESPONSE_BODY => ResponseBodyFilter::class,
		FilterType::RESPONSE_BODY_SIZE => ResponseBodySizeFilter::class
	];

	/**
	 * @param array $data
	 * @return Filter|null
	 */
	public function __invoke(array $data): ?Filter
	{
		$class = self::mapping[$data['typeName']] ?? null;
		if ($class === null) {
			return null;
		}

		$filter = new $class();

		if ($filter instanceof NotFilter) {
			$filter->setChildHash($data['childHash']);
		}

		if ($filter instanceof SetFilter) {
			$filter->setOperator($data['operator']);
			$filter->setChildHashes($data['childHashes']);
		}

		if ($filter instanceof HttpMethodFilter) {
			$filter->setValue($data['value']);
		}

		if ($filter instanceof DomainFilter || $filter instanceof PathFilter) {
			$filter->setPattern((new RegularExpressionFactory())($data['pattern']));
		}

		if ((new \ReflectionClass($filter))->isSubclassOf(KeyValueFilter::class)) {
			$filter->setValuePattern(isset($data['valuePattern']) ? (new RegularExpressionFactory())($data['valuePattern']) : null);
			$filter->setKeyPattern(isset($data['keyPattern']) ? (new RegularExpressionFactory())($data['keyPattern']) : null);
		}

		if ((new \ReflectionClass($filter))->isSubclassOf(RangeFilter::class)) {
			$filter->setRange((new RangeFactory())($data['range']));
		}

		return $filter;
	}
}
