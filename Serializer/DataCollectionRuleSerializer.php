<?php

namespace Bearer\Sh\Serializer;

use Bearer\Sh\Model\DataCollectionRule;

/**
 * Class DataCollectionRuleSerializer
 * @package Bearer\Sh\Serializer
 */
class DataCollectionRuleSerializer
{
	/**
	 * @param DataCollectionRule $dataCollectionRule
	 * @return array
	 */
	public function __invoke(DataCollectionRule $dataCollectionRule): array
	{
		return [
			'filterHash' => $dataCollectionRule->getFilterHash(),
			'params' => $dataCollectionRule->getParams(),
			'signature' => $dataCollectionRule->getSignature()
		];
	}
}
