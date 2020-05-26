<?php

namespace Bearer\Sh\Factory;

use Bearer\Sh\Enum\LogLevel;
use Bearer\Sh\Enum\ReportLogType;
use Bearer\Sh\Enum\StageType;
use Bearer\Sh\Model\Configuration;
use Bearer\Sh\Model\DataCollectionRule;
use Bearer\Sh\Model\ReportLog;
use Bearer\Sh\Request\CurlRequest;
use Bearer\Sh\Serializer\ShaPayloadSerializer;

/**
 * Class ReportLogFactory
 * @package Bearer\Sh\Factory
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

		$log->setLogLevel(LogLevel::RESTRICTED);
		$log->setStartedAt($response->getStartTime());
		$log->setEndedAt($response->getEndTime());

		$log->setType($response->isSuccess() ? ReportLogType::SUCCESS : ReportLogType::ERROR);
		$log->setStageType(StageType::RESPONSE);

		$log->setHostname($response->getUrlInformation()['host'] ?? '');
		$log->setProtocol($response->getUrlInformation()['scheme'] ?? 'http');
		$log->setPort($response->getUrlInformation()['port'] ?? $log->getProtocol() === 'https' ? 443 : 80);

		$log->setUrl($response->getUrlInformation()['url']);
		$log->setMethod($response->getMethod());
		$log->setRequestHeaders($response->getRequestHeaders());
		$log->setPath($response->getUrlInformation()['path']);

		$log->setResponseHeaders($response->getResponseHeaders());
		$log->setStatusCode($response->getStatusCode());

		$log->setRequestBody($response->getRequestBody());
		$log->setResponseBody($response->getResponseBody());
		
		$log->setRequestBodyPayloadSha((new ShaPayloadFactory())($log->getRequestBody()));
		$log->setResponseBodyPayloadSha((new ShaPayloadFactory())($log->getResponseBody()));

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
