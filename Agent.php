<?php

namespace Bearer;

use Bearer\Async\Task\ConfigurationTask;
use Bearer\Model\Configuration;

class Agent
{
	/**
	 * @param array $options
	 */
	public static function init(array $options): void
	{
		(new Agent())->configure($options);
	}

	/**
	 * @param array $options
	 * @return $this
	 */
	private function configure(array $options): self
	{
		$configuration = Configuration::get($options);
		try {
			if (!$configuration->isDisabled() && !$configuration->isDebug()) {
				AgentHandlerFactory::build();
				ConfigurationTask::get()->run();
			}
		} catch (\Exception $e) {

		}

		return $this;
	}
}
