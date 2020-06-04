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
			self::verbose('Agent', 'initialization');
			if (!$configuration->isDisabled() && !$configuration->isDebug()) {
				AgentHandlerFactory::build();
				ConfigurationTask::get()->run();
			}
		} catch (\Exception $e) {
			self::verbose('Agent', 'error', $e->getMessage(), true);
		}

		return $this;
	}

	/**
	 * @param string $tag
	 * @param string $message
	 * @param null $data
	 * @param bool $force
	 */
	public static function verbose(string $tag, string $message, $data = null, bool $force = false): void
	{
		if (Configuration::get()->isVerbose() || $force) {
			error_log(
				sprintf(($data === null ? "[%s] %s - %s" : "[%s] %s - %s : %s"), 'bearer', $tag, $message, $data)
			);
		}
	}
}
