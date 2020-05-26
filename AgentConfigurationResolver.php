<?php

namespace Bearer\Sh;

use Bearer\Sh\Enum\FilterType;
use Bearer\Sh\Model\Configuration;
use Bearer\Sh\Factory\ConfigurationFactory;
use Bearer\Sh\ObjectTransformer;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AgentConfigurationResolver
 * @package Bearer\Sh
 */
class AgentConfigurationResolver
{
	/**
	 * @param array $options
	 * @return Configuration
	 */
	public static function resolve(array $options): Configuration
	{
		$resolver = new OptionsResolver();

		/**
		 * @var string $field
		 * @var array $field_config
		 */
		foreach (self::getConfiguration() as $field => $field_config) {
			$field_config = (new OptionsResolver())
				->setDefined(['default', 'types'])
				->setDefaults([
					'normalizer' => null,
					'normalizer_type' => 'single'
				])
				->setAllowedValues('normalizer_type', ['single', 'multiple'])
				->resolve($field_config);;

			if (isset($field_config['default'])) {
				$resolver->setDefault($field, $field_config['default']);
			} else {
				$resolver->setDefined($field);
			}

			if (isset($field_config['types'])) {
				$resolver->setAllowedTypes($field, $field_config['types']);
			}

			if ($field_config['normalizer'] !== null) {
				$resolver->setNormalizer($field, $field_config['normalizer_type'] === 'single' ? $field_config['normalizer_type'] : function (OptionsResolver $resolver, array $data) use ($field_config) {
					foreach ($data as $i => $value) {
						$nested_resolver = new OptionsResolver();
						$field_config['normalizer']($nested_resolver);
						$data[$i] = $nested_resolver->resolve($value);
					}

					return $data;
				});
			}
		}
		return (new ConfigurationFactory)($resolver->resolve($options));
	}

	/**
	 * @return array
	 */
	private static function getConfiguration(): array
	{
		return [
			'debug' => [
				'default' => false,
				'types' => 'bool'
			],
			'secretKey' => [
				'default' => null,
				'types' => 'string'
			],
			'environment' => [
				'default' => $_SERVER['env'] ?? $_SERVER['APP_ENV'] ?? $_ENV['env'] ?? $_ENV['APP_ENV'] ?? 'default',
				'types' => 'string'
			],
			'disabled' => [
				'default' => function (Options $options) {
					return $options->offsetExists('secretKey') ? $options->offsetGet('secretKey') === null : true;
				},
				'types' => 'bool'
			],
			'stripSensitiveKeys' => [
				'default' => null,
				'types' => 'string',
			],
			'stripSensitiveRegex' => [
				'default' => null,
				'types' => 'string',
			],
			'stripSensitiveData' => [
				'default' => true,
				'types' => 'bool'
			],
			'configHost' => [
				'default' => 'config.bearer.sh',
				'types' => 'string'
			],
			'reportHost' => [
				'default' => 'agent.bearer.sh',
				'types' => 'string'
			]
		];
	}
}
