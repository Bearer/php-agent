<?php

namespace Bearer\Sh\Async\Task;

use Bearer\Sh\Factory\ModelSerializer;
use Bearer\Sh\Model\Configuration;
use Bearer\Sh\ObjectTransformer;
use Bearer\Sh\Serializer\ConfigurationSerializer;

/**
 * Class ConfigurationTask
 * @package Bearer\Sh\Async\Task
 */
class ConfigurationTask extends AbstractAsyncTask
{
	/**
	 * @var null
	 */
	private static $instance = null;

	/**
	 * @var array|null
	 */
	private $data = null;

	/**
	 * @return ConfigurationTask
	 */
	public static function get()
	{
		if (self::$instance === null) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * @return bool
	 */
	public function isLoad(): bool
	{
		return $this->data !== null;
	}

	/**
	 * @return callable
	 */
	public function __invoke(): callable
	{
		$configuration = Configuration::get();
		$configuration_data = (new ConfigurationSerializer())($configuration);

		return function () use($configuration, $configuration_data) {
			$ch = curl_init(sprintf("https://%s/config", $configuration->getConfigHost()));
			curl_setopt_array($ch, [
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POSTFIELDS => json_encode($configuration_data, JSON_NUMERIC_CHECK),
				CURLOPT_HTTPHEADER => [
					sprintf("Authorization:%s", $configuration->getSecretKey()),
					'Content-Type:application/json'
				]
			]);

			return curl_exec($ch);
		};
	}

	/**
	 * @param $json
	 */
	public function then($json): void
	{
		$data = json_decode($json, true);
		if($data !== false) {
			$this->data = $data;
		} else {
			$this->data = null;
		}
	}

	/**
	 * @return array|null
	 */
	public function getData(): ?array
	{
		return $this->data;
	}

	/**
	 * @return int
	 */
	public function sleep(): int
	{
		return 5;
	}
}
