<?php

namespace Bearer\Sh\Factory;

use Bearer\Sh\Enum\FilterType;
use Bearer\Sh\Model\Filters\ConnectionErrorFilter;
use Bearer\Sh\Model\Filters\DomainFilter;
use Bearer\Sh\Model\Filters\Filter;
use Bearer\Sh\Model\Filters\HttpMethodFilter;
use Bearer\Sh\Model\Filters\NotFilter;
use Bearer\Sh\Model\Filters\ParamFilter;
use Bearer\Sh\Model\Filters\PathFilter;
use Bearer\Sh\Model\Filters\RequestHeaderFilter;
use Bearer\Sh\Model\Filters\ResponseHeaderFilter;
use Bearer\Sh\Model\Filters\SetFilter;
use Bearer\Sh\Model\Filters\StatusCodeFilter;

/**
 * Class FilterFactory
 * @package Bearer\Sh\Factory
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
		FilterType::CONNECTION_ERROR => ConnectionErrorFilter::class
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

		if ($filter instanceof ResponseHeaderFilter
			|| $filter instanceof RequestHeaderFilter
			|| $filter instanceof ParamFilter
		) {
			$filter->setValuePattern((new RegularExpressionFactory())($data['valuePattern']));
			$filter->setKeyPattern((new RegularExpressionFactory())($data['keyPattern']));
		}

		if ($filter instanceof StatusCodeFilter) {
			$filter->setRange((new RangeFactory())($data['range']));
		}

		return $filter;
	}
}
