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
	public function __invoke(?Agent $agent = null): array
	{
		if($agent === null) {
			$agent = (new AgentFactory())();
		}

		return [
			'type' => $agent->getType(),
			'version' => $agent->getVersion()
		];
	}
}
