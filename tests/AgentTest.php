<?php

namespace Bearer\Test;

use Bearer\Agent;
use Bearer\Model\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\OptionsResolver\Exception\UndefinedOptionsException;

/**
 * Class AgentTest
 */
class AgentTest extends TestCase
{
	/**
	 * @return void
	 */
	public function testAgentInvalidArgument(): void
	{
		try {
			Agent::init([
				'wrong_parameter' => true
			]);
		} catch (\Exception $e) {
			$this->assertInstanceOf(UndefinedOptionsException::class, $e);
		}
	}

	/**
	 * @return void
	 */
	public function testAgentConfiguration(): void
	{
		Agent::init([
			'secretKey' => "secret_key",
			'debug' => true
		]);

		$configuration = Configuration::get();

		$this->assertSame("secret_key", $configuration->getSecretKey());
		$this->assertSame(false, $configuration->isDisabled());
		$this->assertSame(true, $configuration->isDebug());
	}
}
