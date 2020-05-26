<?php

namespace Bearer\Sh\Test;

use Bearer\Sh\AgentHandlerFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class AgentHandlerFactoryTest
 * @package Bearer\Sh\Test
 */
class AgentHandlerFactoryTest extends TestCase
{
	/**
	 * @return void
	 */
	public function testBaseMethodCreated(): void
	{
		AgentHandlerFactory::build();

		$this->assertTrue(function_exists('base_curl_exec'));
		$this->assertTrue(function_exists('base_curl_setopt'));
		$this->assertTrue(function_exists('base_curl_multi_exec'));
		$this->assertTrue(function_exists('base_curl_multi_add_handle'));
	}
}
