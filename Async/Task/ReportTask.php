<?php

namespace Bearer\Sh\Async\Task;

use Bearer\Sh\Agent;
use Bearer\Sh\Factory\ModelFactory;
use Bearer\Sh\Factory\ModelSerializer;
use Bearer\Sh\Model\Configuration;
use Bearer\Sh\Request\CurlRequest;
use Bearer\Sh\Factory\ConfigurationFactory;
use Bearer\Sh\Factory\ReportFactory;
use Bearer\Sh\ObjectTransformer;
use Bearer\Sh\Serializer\ReportSerializer;

/**
 * Class ReportTask
 * @package Bearer\Sh\Async\Task
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
			Agent::verbose('Configuration','waiting');
			ConfigurationTask::get()
				->wait()
				->run();
		}

		(new ConfigurationFactory())(ConfigurationTask::get()->getData(), Configuration::get());
	}

	/**
	 * @return callable
	 */
	public function __invoke(): callable
	{
		$this->request->setState(CurlRequest::STATE_SEND);

		$configuration = Configuration::get();

		Agent::verbose('Report', 'build',  intval($this->ch));
		$report = (new ReportFactory())(CurlRequest::get($this->ch));

		Agent::verbose('Report', 'serialize',  intval($this->ch));
		$data = (new ReportSerializer())($report);

		return function () use ($configuration, $data) {
			$ch = curl_init();
			base_curl_setopt_array($ch, [
				CURLOPT_URL => sprintf('https://%s/logs', $configuration->getReportHost()),
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => json_encode($data,
					JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_UNESCAPED_LINE_TERMINATORS | JSON_PARTIAL_OUTPUT_ON_ERROR | JSON_PRETTY_PRINT
				),
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
	 * @param $output
	 */
	public function then($output): void
	{
		Agent::verbose('Report',
			sprintf('sended : %s', intval($this->ch))
		);
	}

	/**
	 * @return bool
	 */
	public function prevent(): bool
	{
		return $this->request->isSend();
	}
}
