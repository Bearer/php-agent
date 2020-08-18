<?php

namespace Bearer\Test;

use Bearer\AgentConfigurationResolver;
use PHPUnit\Framework\TestCase;

uses(TestCase::class)->group('configuration');


test('environment : default', function () {
	$this->assertSame(
		null,
		(AgentConfigurationResolver::resolve([]))->getEnvironment()
	);
});

test('environment : SERVER', function () {
	$_SERVER['env'] = "server_test";
	$this->assertSame(
		"server_test",
		(AgentConfigurationResolver::resolve([]))->getEnvironment()
	);
});

test('environment : APP_ENV', function () {
	$_ENV['APP_ENV'] = "server_test";
	$this->assertSame(
		"server_test",
		(AgentConfigurationResolver::resolve([]))->getEnvironment()
	);
});
