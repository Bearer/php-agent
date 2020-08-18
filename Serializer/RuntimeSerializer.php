<?php

namespace Bearer\Serializer;

use Bearer\Model\Runtime;
use Bearer\Factory\RuntimeFactory;

/**
 * Class RuntimeSerializer
 * @package Bearer\Serializer
 */
class RuntimeSerializer
{
	/**
	 * @param Runtime $runtime
	 * @return array
	 */
	public function __invoke($runtime = null)
	{
		if($runtime === null) {
			$factory = new RuntimeFactory();
			$runtime = $factory();
		}

		return [
			'arch' => $runtime->getArch(),
			'type' => $runtime->getType(),
			'platform' => $runtime->getPlatform(),
			'hostname' => $runtime->getHostname(),
			'version' => $runtime->getVersion()
		];
	}
}
