<?php

namespace Bearer\Test;

use Bearer\AgentHandlerFactory;
use Bearer\Model\Configuration;
use PHPUnit\Framework\TestCase;

/**
 * Class AgentHandlerFactoryTest
 * @package Bearer\Test
 */
class AgentHandlerFactoryTest extends TestCase
{
	/**
	 * @return void
	 */
	public function testBaseMethodCreated(): void
	{
		Configuration::get([
			'verbose' => false
		]);
		AgentHandlerFactory::build();

		$this->assertTrue(function_exists('base_curl_exec'));
		$this->assertTrue(function_exists('base_curl_setopt'));
		$this->assertTrue(function_exists('base_curl_multi_exec'));
		$this->assertTrue(function_exists('base_curl_multi_add_handle'));
	}
}
