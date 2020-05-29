<?php

namespace Bearer\Async\Task;

use Bearer\Factory\ConfigurationFactory;
use Bearer\Factory\ModelFactory;
use Bearer\Factory\ModelSerializer;
use Bearer\Factory\ReportFactory;
use Bearer\Model\Configuration;
use Bearer\ObjectTransformer;
use Bearer\Request\CurlRequest;
use Bearer\Serializer\ReportSerializer;

/**
 * Class ReportTask
 * @package Bearer\Async\Task
 */
class ReportTask extends AbstractTask
{
	/**
	 * @var resource
	 */
	private $ch;

	/**
	 * @var CurlRequest
	 */
	private $request;

	/**
	 * ReportTask constructor.
	 * @param $ch
	 */
	public function __construct($ch)
	{
		$this->ch = $ch;
		$this->request = CurlRequest::get($ch);

		if (!ConfigurationTask::get()->isLoad()) {
			ConfigurationTask::get()
				->wait()
				->run();
		}

		$configuration_data = ConfigurationTask::get()->getData();
		if ($configuration_data !== null) {
			(new ConfigurationFactory())($configuration_data, Configuration::get());
		}
	}

	/**
	 * @return callable
	 */
	public function __invoke(): callable
	{
		$this->request->setState(CurlRequest::STATE_SEND);

		$configuration = Configuration::get();

		$data = (new ReportSerializer())(
			(new ReportFactory())(CurlRequest::get($this->ch))
		);

		return function () use ($configuration, $data) {
			$ch = curl_init();
			base_curl_setopt_array($ch, [
				CURLOPT_URL => sprintf('https://%s/logs', $configuration->getReportHost()),
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => json_encode($data, JSON_NUMERIC_CHECK),
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_FORBID_REUSE => true,
				CURLOPT_CONNECTTIMEOUT => 10,
				CURLOPT_DNS_CACHE_TIMEOUT => 10,
				CURLOPT_FRESH_CONNECT => true,
				CURLOPT_TIMEOUT => 1,
				CURLOPT_NOSIGNAL => 1,
				CURLOPT_HTTPHEADER => [
					sprintf("Authorization:%s", $configuration->getSecretKey()),
					'Content-Type:application/json'
				]
			]);
			base_curl_exec($ch);
			curl_close($ch);

			return true;
		};
	}

	/**
	 * @return bool
	 */
	public function prevent(): bool
	{
		return $this->request->isSend();
	}
}
