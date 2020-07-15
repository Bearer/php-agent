<?php

namespace Bearer\Factory;

use Bearer\Enum\LogLevel;
use Bearer\Enum\ReportLogType;
use Bearer\Enum\StageType;
use Bearer\Model\Configuration;
use Bearer\Model\DataCollectionRule;
use Bearer\Model\ReportLog;
use Bearer\Request\CurlRequest;

/**
 * Class ReportLogFactory
 * @package Bearer\Factory
 */
class ReportLogFactory
{
	/**
	 * @param CurlRequest $request
	 * @return ReportLog
	 */
	public function __invoke(CurlRequest $request): ReportLog
	{
		$response = $request->getResponse();

		$log = new ReportLog();

		$response->getResponseBody();

		$log->setLogLevel(LogLevel::DETECTED);
		$log->setStartedAt($response->getStartTime());
		$log->setEndedAt($response->getEndTime());

		$log->setType($response->isSuccess() ? ReportLogType::SUCCESS : ReportLogType::ERROR);
		$log->setStageType($response->getStatusCode() === null ? StageType::REQUEST : StageType::BODIES);

		$log->setHostname($response->getUrlInformation()['host'] ?? '');
		$log->setProtocol($response->getUrlInformation()['scheme'] ?? 'http');
		$log->setPort(($response->getUrlInformation()['port'] ?? $log->getProtocol()) === 'https' ? 443 : 80);

		$log->setUrl($response->getUrlInformation()['url']);
		$log->setMethod($response->getMethod());
		$log->setPath($response->getUrlInformation()['path']);
		$log->setStatusCode($response->getStatusCode());

		$log->setRequestHeaders($response->getRequestHeaders());
		$log->setRequestBody($response->getRequestBody());
		$log->setRequestBodyPayloadSha((new ShaPayloadFactory())($log->getRequestBody()));

		if ($log->getType() === ReportLogType::SUCCESS) {
			$log->setResponseHeaders($response->getResponseHeaders());
			$log->setResponseBody($response->getResponseBody());
			$log->setResponseBodySize($response->getResponseBodySize());
			$log->setResponseBodyPayloadSha((new ShaPayloadFactory())($log->getResponseBody()));
		}

		if ($log->getType() === ReportLogType::ERROR) {
			$log->setErrorCode($response->getStatusCode());
			$log->setErrorFullMessage($response->getResponseBody());
		}
		/** @var DataCollectionRule $dataCollectionRule */
		foreach (Configuration::get()->getActiveDataCollectionRules() as $dataCollectionRule) {
			if (
				$dataCollectionRule->getFilterHash() === null ||
				(
					($filter = Configuration::get()->getFilter($dataCollectionRule->getFilterHash())) &&
					$filter->match($log)
				)
			) {
				$log->addActiveDataCollectionRules($dataCollectionRule);
				if ($dataCollectionRule->getConfig() !== null && $dataCollectionRule->getConfig()->getLogLevel() !== null) {
					$log->setLogLevel($dataCollectionRule->getConfig()->getLogLevel());
				}
			}
		}

		return $log;
	}
}
