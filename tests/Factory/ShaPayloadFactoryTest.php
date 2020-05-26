<?php

namespace Bearer\Sh\Test\Factory;

use Bearer\Sh\Factory\ShaPayloadFactory;
use Bearer\Sh\Model\ShaPayload\ShaPayloadTypeArray;
use Bearer\Sh\Model\ShaPayload\ShaPayloadTypeBoolean;
use Bearer\Sh\Model\ShaPayload\ShaPayloadTypeNull;
use Bearer\Sh\Model\ShaPayload\ShaPayloadTypeObject;
use Bearer\Sh\Model\ShaPayload\ShaPayloadTypeString;
use PHPUnit\Framework\TestCase;

/**
 * Class ShaPayloadFactoryTest
 * @package Bearer\Sh\Test\Factory
 */
class ShaPayloadFactoryTest extends TestCase
{
	private const sponge_bob = [
		"name" => "Sponge Bob",
		"age" => 12,
		"friends" => ["patrick", "mr krab", "starman"]
	];

	private const patrick = [
		"name" => "Patrick",
		"age" => 5,
		"friends" => ["Sponge Bob", "mr krab", "starman"]
	];

	/**
	 * @return void
	 */
	public function testResult(): void
	{
		$this->assertSame(
			"9d50c0ee5be33590542a35b92f4bfef7770aae21927d4ba8f4804fb108cb3b55",
			(new ShaPayloadFactory())(json_encode(self::sponge_bob, JSON_NUMERIC_CHECK))
		);
	}

	/**
	 * @return void
	 */
	public function testSameStructureSameResult(): void
	{
		$this->assertSame(
			(new ShaPayloadFactory())(json_encode(self::patrick, JSON_NUMERIC_CHECK)),
			(new ShaPayloadFactory())(json_encode(self::sponge_bob, JSON_NUMERIC_CHECK))
		);
	}

	/**
	 * @return void
	 */
	public function testPayloadType(): void
	{
		$factory = new ShaPayloadFactory();

		$reflection = new \ReflectionClass(get_class($factory));
		$method = $reflection->getMethod('build');
		$method->setAccessible(true);

		$this->assertInstanceOf(ShaPayloadTypeArray::class, $method->invokeArgs($factory, [
			[]
		]));
		$this->assertInstanceOf(ShaPayloadTypeBoolean::class, $method->invokeArgs($factory, [
			true
		]));
		$this->assertInstanceOf(ShaPayloadTypeObject::class, $method->invokeArgs($factory, [
			self::sponge_bob
		]));
		$this->assertInstanceOf(ShaPayloadTypeString::class, $method->invokeArgs($factory, [
			"sponge_bob"
		]));
		$this->assertInstanceOf(ShaPayloadTypeNull::class, $method->invokeArgs($factory, [
			null
		]));
	}
}
