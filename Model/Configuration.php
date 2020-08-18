<?php

namespace Bearer\Model;

use Bearer\AgentConfigurationResolver;
use Bearer\Model\Filters\Filter;

/**
 * Class Configuration
 */
class Configuration
{
	/**
	 * @var Configuration
	 */
	private static $instance = null;

	/**
	 * @var string|null
	 */
	private $environment = null;

	/**
	 * @var bool
	 */
	private $debug = false;

	/**
	 * @var bool
	 */
	private $verbose = false;

	/**
	 * @var string|null
	 */
	private $secretKey = null;

	/**
	 * @var bool
	 */
	private $disabled = true;

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
	public static function get($options = [])
	{
		if (!empty($options)) {
			self::$instance = AgentConfigurationResolver::resolve($options);
		}

		if (self::$instance === null) {
			self::$instance = new Configuration();
		}

		return self::$instance;
	}

	/**
	 * @return string|null
	 */
	public function getEnvironment(): ?string
	{
		return $this->environment;
	}

	/**
	 * @param string|null $environment
	 * @return Configuration
	 */
	public function setEnvironment($environment)
	{
		$this->environment = $environment ? strtolower($environment) : null;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getSecretKey()
	{
		return $this->secretKey;
	}

	/**
	 * @param string|null $secretKey
	 * @return Configuration
	 */
	public function setSecretKey($secretKey)
	{
		$this->secretKey = $secretKey;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isDebug()
	{
		return $this->debug;
	}

	/**
	 * @param bool $debug
	 * @return Configuration
	 */
	public function setDebug($debug)
	{
		$this->debug = $debug;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isDisabled()
	{
		return $this->disabled;
	}

	/**
	 * @param bool $disabled
	 * @return Configuration
	 */
	public function setDisabled($disabled)
	{
		$this->disabled = $disabled;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isVerbose()
	{
		return $this->verbose;
	}

	/**
	 * @param bool $verbose
	 * @return Configuration
	 */
	public function setVerbose($verbose)
	{
		$this->verbose = $verbose;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getFilters()
	{
		return $this->filters;
	}

	/**
	 * @param array $filters
	 * @param bool|null $reset
	 * @return $this
	 */
	public function setFilters($filters, $reset = false)
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
	public function getFilter($hash)
	{
		return isset($this->filters[$hash]) ? $this->filters[$hash] : null;
	}

	/**
	 * @return string
	 */
	public function getConfigHost()
	{
		return $this->configHost;
	}

	/**
	 * @param string $configHost
	 * @return Configuration
	 */
	public function setConfigHost($configHost)
	{
		$this->configHost = $configHost;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getReportHost()
	{
		return $this->reportHost;
	}

	/**
	 * @param string $reportHost
	 * @return Configuration
	 */
	public function setReportHost($reportHost)
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
		if (!is_string($data)) {
			return $data;
		}

		return preg_replace(
			sprintf('/%s/i', implode('|', $this->getStripSensitiveRegex())),
			'[FILTERED]',
			$data
		);
	}

	/**
	 * @return string[]
	 */
	public function getStripSensitiveRegex()
	{
		return $this->stripSensitiveRegex;
	}

	/**
	 * @param array $stripSensitiveRegex
	 * @param bool|null $reset
	 * @return $this
	 */
	public function setStripSensitiveRegex($stripSensitiveRegex, $reset = false)
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
	public function matchStripSensitiveKeys($data)
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
	public function getStripSensitiveKeys()
	{
		return $this->stripSensitiveKeys;
	}

	/**
	 * @param array $stripSensitiveKeys
	 * @param bool|null $reset
	 * @return $this
	 */
	public function setStripSensitiveKeys($stripSensitiveKeys, $reset = false)
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
	public function isStripSensitiveData()
	{
		return $this->stripSensitiveData;
	}

	/**
	 * @param bool $stripSensitiveData
	 * @return Configuration
	 */
	public function setStripSensitiveData($stripSensitiveData)
	{
		$this->stripSensitiveData = $stripSensitiveData;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getActiveDataCollectionRules()
	{
		return array_filter($this->getDataCollectionRules(), function ($rule) {
			return $rule->getConfig() === null ? true : $rule->getConfig()->isActive();
		});
	}

	/**
	 * @return array
	 */
	public function getDataCollectionRules()
	{
		return $this->dataCollectionRules;
	}

	/**
	 * @param array $dataCollectionRules
	 * @param bool|null $reset
	 * @return Configuration
	 */
	public function setDataCollectionRules($dataCollectionRules, $reset = false)
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
