<?php

namespace Bearer\Factory;

use Bearer\Model\Configuration;

/**
 * Class ConfigurationFactory
 * @package Bearer\Factory
 */
class ConfigurationFactory
{

	/**
	 * @param array $data
	 * @param Configuration|null $configuration
	 * @return Configuration
	 */
	public function __invoke($data, $configuration = null)
	{
		if (!isset($configuration)) {
			$configuration = new Configuration();
		}

		$configuration->setEnvironment(isset($data["environment"]) ? $data["environment"] : $configuration->getEnvironment());
		$configuration->setDebug(isset($data["debug"]) ? $data["debug"] : $configuration->isDebug());
		$configuration->setSecretKey(isset($data["secretKey"]) ? $data["secretKey"] : $configuration->getSecretKey());
		$configuration->setVerbose(isset($data["verbose"]) ? $data["verbose"] : $configuration->isVerbose());
		$configuration->setDisabled(isset($data["disabled"]) ? $data["disabled"] : $configuration->isDisabled());

		foreach (isset($data['dataCollectionRules']) ? $data['dataCollectionRules'] : [] as $i => $rule) {
			$factory = new DataCollectionRuleFactory();
			$data['dataCollectionRules'][$i] = $factory($rule);
		}

		$configuration->setDataCollectionRules(isset($data['dataCollectionRules']) ? $data['dataCollectionRules'] : []);

		foreach (isset($data['filters']) ? $data['filters'] : [] as $hash => $filter) {
			$factory = new FilterFactory();
			$data['filters'][$hash] = $factory($filter);
			if ($data['filters'][$hash] === null) {
				unset($data['filters'][$hash]);
			}
		}
		$configuration->setFilters(isset($data['filters']) ? $data['filters'] : []);

		$configuration->setStripSensitiveData(isset($data['stripSensitiveData']) ? $data['stripSensitiveData'] : $configuration->isStripSensitiveData());
		$configuration->setStripSensitiveKeys(isset($data['stripSensitiveKeys']) ? [$data['stripSensitiveKeys']] : []);
		$configuration->setStripSensitiveRegex(isset($data['stripSensitiveRegex']) ? [$data['stripSensitiveRegex']] : []);
		$configuration->setConfigHost(isset($data["configHost"]) ? $data["configHost"] : $configuration->getConfigHost());
		$configuration->setReportHost(isset($data["reportHost"]) ? $data["reportHost"] : $configuration->getReportHost());

		return $configuration;
	}
}
