<?php

namespace Bearer\Handler;

use Bearer\Agent;
use Bearer\Async\Task\ReportTask;

/**
 * Interface AbstractHandler
 * @package Bearer\Handler
 */
abstract class AbstractHandler
{
	/**
	 * @return string
	 */
	public abstract static function getMethod(): string;

	/**
	 * @param $ch
	 * @param null $mh
	 * @param null $response
	 * @return void
	 */
	protected function report($ch): void
	{
		Agent::verbose('Request', 'catched', intval($ch));

		try {
			(new ReportTask($ch))->run();
		} catch (\Exception $e) {
			Agent::verbose(
				'Request',
				sprintf('error on %s', intval($ch))
				, $e->getMessage(),
				true
			);
		}
	}
}
