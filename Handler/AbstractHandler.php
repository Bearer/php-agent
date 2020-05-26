<?php

namespace Bearer\Sh\Handler;

use Bearer\Sh\Async\Task\ReportTask;

/**
 * Interface AbstractHandler
 * @package Bearer\Sh\Handler
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
		(new ReportTask($ch))->run();
	}
}
