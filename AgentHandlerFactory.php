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

/**
 * Class AgentHandlerFactory
 * @package Bearer
 */
class AgentHandlerFactory
{
	/**
	 * @var array
	 */
	private const handlers = [
		ExecHandler::class,
		SetOptHandler::class,
		SetOptArrayHandler::class,
		MultiExecHandler::class,
		MultiSetOptHandler::class,
		MultiInfoReadHandler::class,
		MultiAddHandleHandler::class,
		MultiRemoveHandleHandler::class,
		MultiCloseHandler::class
	];

	/**
	 * @throws \ReflectionException
	 */
	public static function build(): void
	{
		/** @var AbstractHandler $handler */
		foreach (self::handlers as $handler) {
			if (
				self::exist($handler::getMethod()) &&
				self::rename($handler::getMethod())
			) {
				self::add($handler, $handler::getMethod());
			}
		}
	}

	/**
	 * @param string $method
	 * @return bool
	 */
	private static function exist(string $method): bool
	{
		return function_exists($method);
	}

	/**
	 * @param string $method
	 * @return bool
	 */
	private static function rename(string $method): bool
	{
		return runkit7_function_rename($method, "base_" . $method);
	}

	/**
	 * @param string $class
	 * @param string $method
	 * @return bool
	 * @throws \ReflectionException
	 */
	private static function add(string $class, string $method): bool
	{
		$reflection_class = new \ReflectionClass($class);
		if (!$reflection_class->isSubclassOf(AbstractHandler::class)) {
			throw new \RuntimeException(
				sprintf('Class "%s" need to extend "%s"', $class, AbstractHandler::class)
			);
		}

		$handler_method = $reflection_class->getMethod('__invoke');

		return runkit7_function_add($method,
			self::getParametersString($handler_method, true),
			"return (new $class())(" . self::getParametersString($handler_method) . ");"
		);
	}

	/**
	 * @param \ReflectionMethod $handler_method
	 * @param bool $typed
	 * @return string
	 */
	private static function getParametersString(\ReflectionMethod $handler_method, bool $typed = false): string
	{
		$parameters = array_map(function (\ReflectionParameter $parameter) use ($typed) {
			return trim($typed ?
				sprintf('%s$%s%s',
					$parameter->isPassedByReference() ? '&' : '',
					$parameter->getName(),
					$parameter->isOptional() ? '=null' : ''
				) :
				sprintf('$%s', $parameter->getName())
			);
		}, $handler_method->getParameters());

		return implode(', ', $parameters);
	}


}
