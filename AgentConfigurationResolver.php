<?php

namespace Bearer;

use Bearer\Factory\ConfigurationFactory;
use Bearer\Model\Configuration;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AgentConfigurationResolver
 * @package Bearer
 */
class AgentConfigurationResolver
{
	/**
	 * @param array $options
	 * @return Configuration
	 */
	public static function resolve(array $options): Configuration
	{
		$resolver =
			(new OptionsResolver())
				->setDefaults([
					'debug' => false,
					'secretKey' => null,
					'verbose' => false,
					'environment' => $_SERVER['env'] ?? $_SERVER['APP_ENV'] ?? $_ENV['env'] ?? $_ENV['APP_ENV'] ?? 'default',
					'disabled' => function (Options $options) {
						return $options->offsetExists('secretKey') ? $options->offsetGet('secretKey') === null : true;
					},
					'stripSensitiveKeys' => null,
					'stripSensitiveRegex' => null,
					'stripSensitiveData' => true,
					'configHost' => 'config.bearer.sh',
					'reportHost' => 'agent.bearer.sh'
				])
				->setAllowedTypes('debug', 'bool')
				->setAllowedTypes('secretKey', 'string')
				->setAllowedTypes('verbose', 'bool')
				->setAllowedTypes('environment', 'string')
				->setAllowedTypes('disabled', 'bool')
				->setAllowedTypes('stripSensitiveKeys', 'string')
				->setAllowedTypes('stripSensitiveRegex', 'string')
				->setAllowedTypes('stripSensitiveData', 'bool')
				->setAllowedTypes('configHost', 'string')
				->setAllowedTypes('reportHost', 'string');

		return (new ConfigurationFactory())($resolver->resolve($options));
	}
}
