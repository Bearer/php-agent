<?php

namespace Bearer\Factory;

use Bearer\Model\DynamicConfig;

/**
 * Class DynamicConfigFactory
 * @package Bearer\Factory
 */
class DynamicConfigFactory
{
	/**
	 * @param array $data
	 * @return DynamicConfig
	 */
	public function __invoke(array $data): DynamicConfig
	{
		$config = new DynamicConfig();

		$config->setActive($data['active'] ?? true);
		$config->setLogLevel($data['logLevel']);

		return $config;
	}
}
