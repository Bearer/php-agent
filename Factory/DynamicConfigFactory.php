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
	public function __invoke($data)
	{
		$config = new DynamicConfig();

		$config->setActive(isset($data['active']) ? $data['active'] : true);
		$config->setLogLevel($data['logLevel']);

		return $config;
	}
}
