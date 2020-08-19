<?php

namespace Bearer\Test;

use Bearer\AgentConfigurationResolver;
use PHPUnit\Framework\TestCase;

/**
 * Class AgentConfigurationResolverTest
 * @package Bearer\Test
 */
class AgentConfigurationResolverTest extends TestCase
{
	/**
	 * @return void
	 */
	public function testDefaultEnvironment()
	{
		$resolver = AgentConfigurationResolver::resolve([]);

		$this->assertSame(
			null,
			$resolver->getEnvironment()
		);
	}

	/**
	 * @return void
	 */
	public function testServerEnvironment()
	{
		$_SERVER['env'] = "server_test";
		$resolver = AgentConfigurationResolver::resolve([]);


		$this->assertSame(
			"server_test",
			$resolver->getEnvironment()
		);
	}

	/**
	 * @return void
	 */
	public function testGlobalEnvironment()
	{
		$_ENV['APP_ENV'] = "server_test";
		$resolver = AgentConfigurationResolver::resolve([]);


		$this->assertSame(
			"server_test",
			$resolver->getEnvironment()
		);
	}
}
