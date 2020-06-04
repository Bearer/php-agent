<?php

namespace Bearer\Test\Sanitizer;

use Bearer\Sanitizer\BodySanitizer;
use PHPUnit\Framework\TestCase;

/**
 * Class BodySanitizerTest
 * @package Bearer\Test\Sanitizer
 */
class BodySanitizerTest extends TestCase
{
	private const sponge_bob = [
		"name" => "Sponge Bob",
		"age" => 12,
		"friends" => ["patrick", "mr krab", "starman"]
	];

	/**
	 * @return void
	 */
	public function testSizeAndEmptyData(): void
	{
		$sanitizer = new BodySanitizer();

		$this->assertSame("(no body)", $sanitizer(false, []));
		$this->assertSame("(omitted due to size)", $sanitizer('test', [], 1048577));
	}

	/**
	 * @return void
	 */
	public function testJsonResult(): void
	{
		$this->assertSame(
			json_encode(self::sponge_bob, JSON_NUMERIC_CHECK),
			(new BodySanitizer())(json_encode(self::sponge_bob, JSON_NUMERIC_CHECK), [])
		);
	}

	/**
	 * @return void
	 */
	public function testSensitiveKey(): void
	{
		$this->assertSame(
			json_encode(array_merge(self::sponge_bob, [
				"secret" => "[FILTERED]"
			]), JSON_NUMERIC_CHECK),
			(new BodySanitizer())(json_encode(array_merge(self::sponge_bob, [
				"secret" => "secret"
			]), JSON_NUMERIC_CHECK), [])
		);
	}
}
