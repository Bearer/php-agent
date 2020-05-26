<?php

namespace Bearer\Sh\Factory;

use Bearer\Sh\Model\Configuration;

/**
 * Class ConfigurationFactory
 * @package Bearer\Sh\Factory
 */
class ConfigurationFactory
{

	/**
	 * @param array $data
	 * @param Configuration|null $configuration
	 * @return Configuration
	 */
	public function __invoke(array $data, ?Configuration $configuration = null): Configuration
	{
		if (!isset($configuration)) {
			$configuration = new Configuration();
		}

		$configuration->setEnvironment($data["environment"] ?? $configuration->getEnvironment());
		$configuration->setDebug($data["debug"] ?? $configuration->isDebug());
		$configuration->setSecretKey($data["secretKey"] ?? $configuration->getSecretKey());
		$configuration->setDisabled($data["disabled"] ?? $configuration->isDisabled());

		foreach ($data['dataCollectionRules'] ?? [] as $i => $rule) {
			$data['dataCollectionRules'][$i] = (new DataCollectionRuleFactory())($rule);
		}

		$configuration->setDataCollectionRules($data['dataCollectionRules'] ?? []);

		foreach ($data['filters'] ?? [] as $hash => $filter) {
			$data['filters'][$hash] = (new FilterFactory())($filter);
			if ($data['filters'][$hash] === null) {
				unset($data['filters'][$hash]);
			}
		}
		$configuration->setFilters($data['filters'] ?? []);

		$configuration->setStripSensitiveData($data['stripSensitiveData'] ?? $configuration->isStripSensitiveData());
		$configuration->setStripSensitiveKeys(isset($data['stripSensitiveKeys']) ? [$data['stripSensitiveKeys']] : []);
		$configuration->setStripSensitiveRegex(isset($data['stripSensitiveRegex']) ? [$data['stripSensitiveRegex']] : []);
		$configuration->setConfigHost($data["configHost"] ?? $configuration->getConfigHost());
		$configuration->setReportHost($data["reportHost"] ?? $configuration->getReportHost());

		return $configuration;
	}
}
