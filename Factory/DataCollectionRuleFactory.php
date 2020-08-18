<?php

namespace Bearer\Factory;

use Bearer\Model\DataCollectionRule;

/**
 * Class DataCollectionRuleFactory
 * @package Bearer\Factory
 */
class DataCollectionRuleFactory
{
	/**
	 * @param array $data
	 * @return DataCollectionRule
	 */
	public function __invoke($data)
	{
		$dataCollectionRule = new DataCollectionRule();

		$dynamicConfig = new DynamicConfigFactory();

		$dataCollectionRule->setFilterHash(isset($data['filterHash']) ? $data['filterHash'] : null);
		$dataCollectionRule->setParams($data['params']);
		$dataCollectionRule->setConfig(isset($data['config']) ? $dynamicConfig($data['config']) : null);
		$dataCollectionRule->setSignature($data['signature']);

		return $dataCollectionRule;
	}
}
