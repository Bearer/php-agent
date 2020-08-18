<?php

namespace Bearer\Serializer;

use Bearer\Model\Agent;
use Bearer\Factory\AgentFactory;

/**
 * Class AgentSerializer
 * @package Bearer\Serializer
 */
class AgentSerializer
{
	/**
	 * @param Agent $agent
	 * @return array
	 */
	public function __invoke($agent = null)
	{
		if($agent === null) {
			$factory = new AgentFactory();

			$agent = $factory();
		}

		return [
			'type' => $agent->getType(),
			'version' => $agent->getVersion()
		];
	}
}
