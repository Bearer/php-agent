<?php

namespace Bearer\Sh\Factory;

use Bearer\Sh\Model\Agent;

/**
 * Class AgentFactory
 * @package Bearer\Sh\Factory
 */
class AgentFactory
{
	/**
	 * @return Agent
	 */
	public function __invoke(): Agent
	{
		$agent = new Agent();

		$agent->setType('php');

		$composer_file = __DIR__ . '/../composer.json';
		if (file_exists($composer_file)) {
			$agent->setVersion(
				json_decode(file_get_contents($composer_file), true)['version'] ?? null
			);
		}

		return $agent;
	}
}
