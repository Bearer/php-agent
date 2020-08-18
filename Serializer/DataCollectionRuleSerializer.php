<?php

namespace Bearer\Serializer;

use Bearer\Model\DataCollectionRule;

/**
 * Class DataCollectionRuleSerializer
 * @package Bearer\Serializer
 */
class DataCollectionRuleSerializer
{
	/**
	 * @param DataCollectionRule $dataCollectionRule
	 * @return array
	 */
	public function __invoke($dataCollectionRule)
	{
		return [
			'filterHash' => $dataCollectionRule->getFilterHash(),
			'params' => $dataCollectionRule->getParams(),
			'signature' => $dataCollectionRule->getSignature()
		];
	}
}
