<?php

namespace Bearer\Sh\Factory;

use Bearer\Sh\Model\DataCollectionRule;

/**
 * Class DataCollectionRuleFactory
 * @package Bearer\Sh\Factory
 */
class DataCollectionRuleFactory
{
	/**
	 * @param array $data
	 * @return DataCollectionRule
	 */
	public function __invoke(array $data): DataCollectionRule
	{
		$dataCollectionRule = new DataCollectionRule();

		$dataCollectionRule->setFilterHash($data['filterHash']);
		$dataCollectionRule->setParams($data['params']);
		$dataCollectionRule->setConfig(isset($data['config']) ? (new DynamicConfigFactory())($data['config']) : null);
		$dataCollectionRule->setSignature($data['signature']);

		return $dataCollectionRule;
	}
}
