<?php

namespace Bearer\Async\Task;

use Bearer\Model\Configuration;
use Bearer\Serializer\ConfigurationSerializer;

/**
 * Class ConfigurationTask
 * @package Bearer\Async\Task
 */
class ConfigurationTask extends AbstractTask
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
			$ch = curl_init(sprintf("%s/config", $configuration->getConfigHost()));
			base_curl_setopt_array($ch, [
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POSTFIELDS => json_encode($configuration_data),
				CURLOPT_HTTPHEADER => [
					sprintf("Authorization:%s", $configuration->getSecretKey()),
					'Content-Type:application/json'
				]
			]);

			return base_curl_exec($ch);
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
