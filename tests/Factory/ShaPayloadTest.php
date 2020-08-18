<?php

namespace Bearer\Test\Factory;

use Bearer\Factory\ShaPayloadFactory;
use Bearer\Model\ShaPayload\ShaPayloadTypeArray;
use Bearer\Model\ShaPayload\ShaPayloadTypeBoolean;
use Bearer\Model\ShaPayload\ShaPayloadTypeNull;
use Bearer\Model\ShaPayload\ShaPayloadTypeObject;
use Bearer\Model\ShaPayload\ShaPayloadTypeString;
use PHPUnit\Framework\TestCase;

uses(TestCase::class)->group('factory_shapayload');

$user1 = [
	"name" => "Jean Dupont",
	"age" => 30,
	"friends" => ["Patrick", "Michel", "Roger"]
];

$user2 = [
	"name" => "Mickael Smith",
	"age" => 25,
	"friends" => ["Mike", "Bryan", "Scott"]
];

$example = [
	"result" => ['42'],
	"other" => [
		"value" => "test"
	]
];

test('result : user', function () use ($user1) {
	$factory = new ShaPayloadFactory();

	$this->assertSame(
		"9d50c0ee5be33590542a35b92f4bfef7770aae21927d4ba8f4804fb108cb3b55",
		$factory(json_encode($user1))
	);
});

test('same structure, same result', function () use ($user1, $user2) {
	$factory = new ShaPayloadFactory();

	$this->assertSame(
		$factory(json_encode($user1)),
		$factory(json_encode($user2))
	);
});

test('result : example', function () use ($example) {
	$factory = new ShaPayloadFactory();

	$this->assertSame(
		"5724ab06837a9899f9a901d5bba28daa1794aa482134e2b667d8b48ca9533c09",
		$factory(json_encode($example))
	);
});

test('types', function () use ($user1) {
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
		$user1
	]));
	$this->assertInstanceOf(ShaPayloadTypeString::class, $method->invokeArgs($factory, [
		"sponge_bob"
	]));
	$this->assertInstanceOf(ShaPayloadTypeNull::class, $method->invokeArgs($factory, [
		null
	]));
});
