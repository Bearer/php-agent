<?php

namespace Bearer\Sh\Async\Task;

use Bearer\Sh\Agent;

/**
 * Class AbstractTask
 * @package Bearer\Sh\Async\Task
 */
abstract class AbstractTask
{
	/**
	 * @return callable
	 */
	public abstract function __invoke(): callable;

	/**
	 * @return $this
	 */
	public function run()
	{
		if ($this->prevent()) {
			return $this;
		}

		Agent::verbose('Task', 'run', static::class);

		try {
			$output = ($this())();
			$this->then($output);
		} catch (\Exception $e) {
			$this->catch($e);
		}

		return $this;
	}

	/**
	 * @return bool
	 */
	public function prevent(): bool
	{
		return false;
	}

	/**
	 * @param $output
	 */
	public function then($output): void
	{

	}

	/**
	 * @param \Exception $e
	 */
	public function catch(\Exception $e): void
	{
		Agent::verbose('Task', 'error', $e->getMessage());
	}
}
