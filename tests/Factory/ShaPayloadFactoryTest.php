<?php

namespace Bearer\Test\Factory;

use Bearer\Factory\ShaPayloadFactory;
use Bearer\Model\ShaPayload\ShaPayloadTypeArray;
use Bearer\Model\ShaPayload\ShaPayloadTypeBoolean;
use Bearer\Model\ShaPayload\ShaPayloadTypeNull;
use Bearer\Model\ShaPayload\ShaPayloadTypeObject;
use Bearer\Model\ShaPayload\ShaPayloadTypeString;
use PHPUnit\Framework\TestCase;

/**
 * Class ShaPayloadFactoryTest
 * @package Bearer\Test\Factory
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

	private const validator = [
		"result" => ['42'],
		"other" => [
			"value" => "test"
		]
	];

	/**
	 * @return void
	 */
	public function testResult(): void
	{
		$this->assertSame(
			"9d50c0ee5be33590542a35b92f4bfef7770aae21927d4ba8f4804fb108cb3b55",
			(new ShaPayloadFactory())(json_encode(self::sponge_bob))
		);
	}

	/**
	 * @return void
	 */
	public function testSameStructureSameResult(): void
	{
		$this->assertSame(
			(new ShaPayloadFactory())(json_encode(self::patrick)),
			(new ShaPayloadFactory())(json_encode(self::sponge_bob))
		);
	}

	/**
	 * @return void
	 */
	public function testValidator(): void
	{
		$this->assertSame(
			"5724ab06837a9899f9a901d5bba28daa1794aa482134e2b667d8b48ca9533c09",
			(new ShaPayloadFactory())(json_encode(self::validator))
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
