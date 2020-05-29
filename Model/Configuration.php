<?php

namespace Bearer\Model;

use Bearer\AgentConfigurationResolver;
use Bearer\Model\Filters\Filter;

/**
 * Class Configuration
 * @Serializer\AccessType("public_method")
 */
class Configuration
{
	/**
	 * @var Configuration
	 */
	private static $instance = null;

	/**
	 * @var string
	 */
	private $environment;

	/**
	 * @var bool
	 */
	private $debug = false;

	/**
	 * @var string|null
	 */
	private $secretKey = null;

	/**
	 * @var bool
	 */
	private $disabled = false;

	/**
	 * @var array[hash] Filter
	 */
	private $filters = [];

	/**
	 * @var string
	 */
	private $configHost;

	/**
	 * @var bool
	 */
	private $stripSensitiveData = true;

	/**
	 * @var string[]
	 */
	private $stripSensitiveRegex = [
		'[a-z0-9]{1}[a-z0-9.!#$%&’*+=?^_`{|}~-]+@[a-z0-9-]+(?:\\.[a-z0-9-]+)*',
		'(?:\d[ -]*?){13,16}'
	];

	/**
	 * @var array
	 */
	private $stripSensitiveKeys = [
		'/^authorization$/i',
		'/^password$/i',
		'/^secret$/i',
		'/^passwd$/i',
		'/^api.?key$/i',
		'/^access.?token$/i',
		'/^auth.?token$/i',
		'/^credentials$/i',
		'/^mysql_pwd$/i',
		'/^stripetoken$/i',
		'/^card.?number.?$/i',
		'/^secret$/i',
		'/^client.?id$/i',
		'/^client.?secret$/i'
	];
	/**
	 * @var array
	 */
	private $dataCollectionRules = [];

	/**
	 * @var string
	 */
	private $reportHost;

	/**
	 * @param array $options
	 * @return static
	 */
	public static function get(array $options = []): self
	{
		if (!empty($options)) {
			self::$instance = AgentConfigurationResolver::resolve($options);
		}

		if (self::$instance === null) {
			throw new \RuntimeException('Configuration need to be initialize');
		}

		return self::$instance;
	}

	/**
	 * @return string
	 */
	public function getEnvironment(): string
	{
		return $this->environment;
	}

	/**
	 * @param string $environment
	 * @return Configuration
	 */
	public function setEnvironment(string $environment): self
	{
		$this->environment = $environment;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getSecretKey(): ?string
	{
		return $this->secretKey;
	}

	/**
	 * @param string|null $secretKey
	 * @return Configuration
	 */
	public function setSecretKey(?string $secretKey): self
	{
		$this->secretKey = $secretKey;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isDebug(): bool
	{
		return $this->debug;
	}

	/**
	 * @param bool $debug
	 * @return Configuration
	 */
	public function setDebug(bool $debug): Configuration
	{
		$this->debug = $debug;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isDisabled(): bool
	{
		return $this->disabled;
	}

	/**
	 * @param bool $disabled
	 * @return Configuration
	 */
	public function setDisabled(bool $disabled): self
	{
		$this->disabled = $disabled;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getFilters(): array
	{
		return $this->filters;
	}

	/**
	 * @param array $filters
	 * @param bool|null $reset
	 * @return $this
	 */
	public function setFilters(array $filters, ?bool $reset = false): self
	{
		if ($reset) {
			$this->filters = [];
		}

		foreach ($filters as $i => $filter) {
			if (is_numeric($i)) {
				$this->filters[] = $filter;
			} else {
				$this->filters[$i] = $filter;
			}
		}

		return $this;
	}

	/**
	 * @param string $hash
	 * @return Filter|null
	 */
	public function getFilter(string $hash): ?Filter
	{
		return $this->filters[$hash] ?? null;
	}

	/**
	 * @return string
	 */
	public function getConfigHost(): string
	{
		return $this->configHost;
	}

	/**
	 * @param string $configHost
	 * @return Configuration
	 */
	public function setConfigHost(string $configHost): self
	{
		$this->configHost = $configHost;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getReportHost(): string
	{
		return $this->reportHost;
	}

	/**
	 * @param string $reportHost
	 * @return Configuration
	 */
	public function setReportHost(string $reportHost): self
	{
		$this->reportHost = $reportHost;

		return $this;
	}

	/**
	 * @param $data
	 * @return string|string[]|null
	 */
	public function replaceStripSensitiveRegex($data)
	{
		return preg_replace(
			sprintf('/%s/i', implode('|', $this->getStripSensitiveRegex())),
			'[FILTERED]',
			$data
		);
	}

	/**
	 * @return string[]
	 */
	public function getStripSensitiveRegex(): array
	{
		return $this->stripSensitiveRegex;
	}

	/**
	 * @param array $stripSensitiveRegex
	 * @param bool|null $reset
	 * @return $this
	 */
	public function setStripSensitiveRegex(array $stripSensitiveRegex, ?bool $reset = false): Configuration
	{
		if ($reset) {
			$this->stripSensitiveRegex = [];
		}

		$this->stripSensitiveRegex = array_unique(array_merge($this->stripSensitiveRegex, $stripSensitiveRegex));

		return $this;
	}

	/**
	 * @param string $data
	 * @return bool
	 */
	public function matchStripSensitiveKeys(string $data): bool
	{
		/** @var RegularExpression $expression */
		foreach ($this->getStripSensitiveKeys() as $expression) {
			if (preg_match($expression, $data)) {
				return true;
			}
		}

		return false;
	}

	/**
	 * @return string[]
	 */
	public function getStripSensitiveKeys(): array
	{
		return $this->stripSensitiveKeys;
	}

	/**
	 * @param array $stripSensitiveKeys
	 * @param bool|null $reset
	 * @return $this
	 */
	public function setStripSensitiveKeys(array $stripSensitiveKeys, ?bool $reset = false): Configuration
	{
		if ($reset) {
			$this->stripSensitiveKeys = [];
		}

		$this->stripSensitiveKeys = array_unique(array_merge($this->stripSensitiveKeys, $stripSensitiveKeys));

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isStripSensitiveData(): bool
	{
		return $this->stripSensitiveData;
	}

	/**
	 * @param bool $stripSensitiveData
	 * @return Configuration
	 */
	public function setStripSensitiveData(bool $stripSensitiveData): Configuration
	{
		$this->stripSensitiveData = $stripSensitiveData;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getActiveDataCollectionRules(): array
	{
		return array_filter($this->getDataCollectionRules(), function (DataCollectionRule $rule) {
			return $rule->getConfig() === null ? true : $rule->getConfig()->isActive();
		});
	}

	/**
	 * @return array
	 */
	public function getDataCollectionRules(): array
	{
		return $this->dataCollectionRules;
	}

	/**
	 * @param array $dataCollectionRules
	 * @param bool|null $reset
	 * @return Configuration
	 */
	public function setDataCollectionRules(array $dataCollectionRules, ?bool $reset = false): Configuration
	{
		if ($reset) {
			$this->dataCollectionRules = [];
		}

		/** @var RegularExpression $key */
		foreach ($dataCollectionRules as $rule) {
			$this->dataCollectionRules[] = $rule;
		}

		return $this;
	}
}
