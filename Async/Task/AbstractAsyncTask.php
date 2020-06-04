<?php

namespace Bearer\Sh\Async\Task;

use Bearer\Sh\Agent;
use Bearer\Sh\Async\Pool;

/**
 * Class AbstractAsyncTask
 * @package Bearer\Sh\Async\Task
 */
abstract class AbstractAsyncTask extends AbstractTask
{
	/**
	 * @var Pool|null
	 */
	private $pool = null;

	/**
	 * @return Pool|null
	 */
	public function getPool(): ?Pool
	{
		return $this->pool;
	}

	/**
	 * @return $this
	 */
	public function run()
	{
		if ($this->pool === null) {
			$this->pool = new Pool();
		}

		if ($this->prevent()) {
			return $this;
		}

		Agent::verbose('Task', 'run', static::class);

		$this->pool
			->add($this())
			->then(function ($output) {
				$this->then($output);
				if ($this->sleep() > 0 && !$this->pool->isStopped()) {
					sleep($this->sleep());
					$this->run();
				}
			})
			->catch(function (\Exception $e) {
				$this->catch($e);
			});

		return $this;
	}

	/**
	 * @return int
	 */
	public function sleep(): int
	{
		return 0;
	}

	/**
	 * @param callable|null $callback
	 * @return $this
	 */
	public function wait(?callable $callback = null): self
	{
		if ($this->pool !== null) {
			if ($this->sleep() > 0 && !$this->pool->isStopped()) {
				$this->pool->stop();
			}
			$this->pool->wait();
			if ($callback !== null) {
				$callback($this->pool, $this);
			}
		}

		return $this;
	}
}
