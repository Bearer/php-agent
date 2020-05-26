<?php

namespace Bearer\Sh\Serializer;

use Bearer\Sh\Model\Runtime;
use Bearer\Sh\Factory\RuntimeFactory;

/**
 * Class RuntimeSerializer
 * @package Bearer\Sh\Serializer
 */
class RuntimeSerializer
{
	/**
	 * @param Runtime $runtime
	 * @return array
	 */
	public function __invoke(?Runtime $runtime = null): array
	{
		if($runtime === null) {
			$runtime = (new RuntimeFactory())();
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
