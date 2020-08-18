<?php

namespace Bearer\Test\Sanitizer;

use Bearer\Sanitizer\BodySanitizer;
use PHPUnit\Framework\TestCase;

uses(TestCase::class)->group('body_sanitizer');

$dataset = [
	"name" => "Sponge Bob",
	"age" => 12,
	"friends" => ["patrick", "mr krab", "starman"]
];

test('empty', function () {
	$sanitizer = new BodySanitizer();

	$this->assertSame("(no body)", $sanitizer(false, []));
	$this->assertSame("(omitted due to size)", $sanitizer('test', [], 1048577));
});

test('json', function () use ($dataset) {
	$sanitizer = new BodySanitizer();

	$this->assertSame(
		json_encode($dataset),
		$sanitizer(json_encode($dataset), [])
	);
});

test('sensitive_key', function () use ($dataset) {
	$sanitizer = new BodySanitizer();

	$this->assertSame(
		json_encode(array_merge($dataset, [
			"secret" => "[FILTERED]"
		]), JSON_NUMERIC_CHECK),
		$sanitizer(json_encode(array_merge($dataset, [
			"secret" => "secret"
		]), JSON_NUMERIC_CHECK), [])
	);
});
