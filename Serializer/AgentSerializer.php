<?php

namespace Bearer\Sh\Serializer;

use Bearer\Sh\Model\Agent;
use Bearer\Sh\Factory\AgentFactory;

/**
 * Class AgentSerializer
 * @package Bearer\Sh\Serializer
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
