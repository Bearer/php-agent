<?php

namespace Bearer\Test;

use Bearer\Agent;
use Bearer\Model\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\OptionsResolver\Exception\UndefinedOptionsException;

uses(TestCase::class)->group('agent');

test('has invalid arguments', function () {
	Agent::init([
		'wrong_parameter' => true
	]);
})->throws(UndefinedOptionsException::class);

test('valid arguments', function () {
	Agent::init([
		'secretKey' => "secret_key",
		'debug' => true
	]);

	$configuration = Configuration::get();

	$this->assertSame("secret_key", $configuration->getSecretKey());
	$this->assertSame(false, $configuration->isDisabled());
	$this->assertSame(true, $configuration->isDebug());
	$this->assertSame(false, $configuration->isVerbose());
});
