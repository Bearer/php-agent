<?php

namespace Bearer\Factory;

use Bearer\Model\Runtime;

/**
 * Class RuntimeFactory
 * @package Bearer\Factory
 */
class RuntimeFactory
{
	/**
	 * @return Runtime
	 */
	public function __invoke(): Runtime
	{
		$runtime = new Runtime();

		$runtime->setArch(php_uname('m'));
		$runtime->setPlatform(php_uname('s'));
		$runtime->setType(php_uname('s'));
		$runtime->setHostname(php_uname('n'));
		$runtime->setVersion(php_uname('r'));

		return $runtime;
	}
}
