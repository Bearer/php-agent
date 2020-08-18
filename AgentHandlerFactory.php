<?php

namespace Bearer;

use Bearer\Handler\AbstractHandler;
use Bearer\Handler\ExecHandler;
use Bearer\Handler\Multi\MultiAddHandleHandler;
use Bearer\Handler\Multi\MultiCloseHandler;
use Bearer\Handler\Multi\MultiExecHandler;
use Bearer\Handler\Multi\MultiInfoReadHandler;
use Bearer\Handler\Multi\MultiRemoveHandleHandler;
use Bearer\Handler\Multi\MultiSetOptHandler;
use Bearer\Handler\SetOptArrayHandler;
use Bearer\Handler\SetOptHandler;
use Bearer\Stream\HookProcessor;

/**
 * Class AgentHandlerFactory
 * @package Bearer
 */
class AgentHandlerFactory
{
	/**
	 * @var array
	 */
	const handlers = [
		'curl_exec' => ExecHandler::class,
		'curl_setopt' => SetOptHandler::class,
		'curl_setopt_array' => SetOptArrayHandler::class,
		'curl_multi_exec' => MultiExecHandler::class,
		'curl_multi_setopt' => MultiSetOptHandler::class,
		'curl_multi_info_read' => MultiInfoReadHandler::class,
		'curl_multi_add_handle' => MultiAddHandleHandler::class,
		'curl_multi_remove_handle' => MultiRemoveHandleHandler::class,
		'curl_multi_close' => MultiCloseHandler::class
	];

	/**
	 * @throws \ReflectionException
	 */
	public static function build()
	{
		Agent::verbose('Hook', 'configuration start');
		(new HookProcessor(self::handlers))->intercept();
		Agent::verbose('Hook', 'configuration done');
	}
}
