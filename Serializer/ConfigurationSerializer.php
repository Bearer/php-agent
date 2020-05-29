<?php

namespace Bearer\Serializer;

use Bearer\Model\Configuration;

/**
 * Class ConfigurationSerializer
 * @package Bearer\Serializer
 */
class ConfigurationSerializer
{

	/**
	 * @param Configuration $configuration
	 * @return array
	 */
	public function __invoke(Configuration $configuration): array
	{
		return [
			'runtime' => (new RuntimeSerializer())(),
			'agent' => (new AgentSerializer())(),
			'application' => [
				'environment' => base64_encode($configuration->getEnvironment())
			]
		];
	}
}
