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
	public function testDefaultEnvironment(): void
	{
		$this->assertSame(
			null,
			(AgentConfigurationResolver::resolve([]))->getEnvironment()
		);
	}

	/**
	 * @return void
	 */
	public function testServerEnvironment(): void
	{
		$_SERVER['env'] = "server_test";
		$this->assertSame(
			"server_test",
			(AgentConfigurationResolver::resolve([]))->getEnvironment()
		);
	}

	/**
	 * @return void
	 */
	public function testGlobalEnvironment(): void
	{
		$_ENV['APP_ENV'] = "server_test";
		$this->assertSame(
			"server_test",
			(AgentConfigurationResolver::resolve([]))->getEnvironment()
		);
	}
}
