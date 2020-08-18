<?php

namespace Bearer\Async\Task;

use Bearer\Agent;

/**
 * Class AbstractTask
 * @package Bearer\Async\Task
 */
abstract class AbstractTask
{
	/**
	 * @return callable
	 */
	public abstract function __invoke();

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
			$method = $this();
			$output = $method();
			$this->then($output);
		} catch (\Exception $e) {
			$this->error($e);
		}

		return $this;
	}

	/**
	 * @return bool
	 */
	public function prevent()
	{
		return false;
	}

	/**
	 * @param $output
	 */
	public function then($output)
	{

	}

	/**
	 * @param \Exception $e
	 */
	public function error($e)
	{
		Agent::verbose('Task - ' . static::class, 'error', $e->getMessage());
	}
}
