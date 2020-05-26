<?php

namespace Bearer\Sh\Async\Task;

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

	}
}
