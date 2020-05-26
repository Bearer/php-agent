<?php

namespace Bearer\Sh\Test;

use Bearer\Sh\AgentConfigurationResolver;
use PHPUnit\Framework\TestCase;

/**
 * Class AgentConfigurationResolverTest
 * @package Bearer\Sh\Test
 */
class AgentConfigurationResolverTest extends TestCase
{
	/**
	 * @return void
	 */
	public function testDefaultEnvironment(): void
	{
		$this->assertSame(
			"default",
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
