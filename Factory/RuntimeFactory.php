<?php

namespace Bearer\Sh\Factory;

use Bearer\Sh\Model\Runtime;

/**
 * Class RuntimeFactory
 * @package Bearer\Sh\Factory
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
