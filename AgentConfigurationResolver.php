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
	public static function resolve($options)
	{
		$resolver =
			(new OptionsResolver())
				->setDefaults([
					'debug' => false,
					'secretKey' => null,
					'verbose' => false,
					'environment' =>
						isset($_SERVER['env']) ? $_SERVER['env'] : (
							isset($_SERVER['APP_ENV']) ? $_SERVER['APP_ENV'] : (
								isset($_ENV['env']) ? $_ENV['env'] : (
									isset($_ENV['APP_ENV']) ? $_ENV['APP_ENV'] : null
								)
							)
						),
					'disabled' => function (Options $options) {
						return $options->offsetExists('secretKey') ? $options->offsetGet('secretKey') === null : true;
					},
					'stripSensitiveKeys' => null,
					'stripSensitiveRegex' => null,
					'stripSensitiveData' => true,
					'configHost' => 'https://config.bearer.sh',
					'reportHost' => 'https://agent.bearer.sh'
				])
				->setAllowedTypes('debug', 'bool')
				->setAllowedTypes('secretKey', ['string', 'null'])
				->setAllowedTypes('verbose', 'bool')
				->setAllowedTypes('environment', ['string', 'null'])
				->setAllowedTypes('disabled', 'bool')
				->setAllowedTypes('stripSensitiveKeys', ['string', 'null'])
				->setAllowedTypes('stripSensitiveRegex', ['string', 'null'])
				->setAllowedTypes('stripSensitiveData', 'bool')
				->setAllowedTypes('configHost', 'string')
				->setAllowedTypes('reportHost', 'string');

		$factory = new ConfigurationFactory();

		return $factory($resolver->resolve($options));
	}
}
