<?php

namespace Bearer\Sh\Serializer;

use Bearer\Sh\Enum\LogLevel;
use Bearer\Sh\Model\ReportLog;

/**
 * Class ReportLogSerializer
 * @package Bearer\Sh\Serializer
 */
class ReportLogSerializer
{
	/**
	 * @param ReportLog $reportLog
	 * @return array
	 */
	public function __invoke(ReportLog $reportLog): array
	{
		$export = [
			'logLevel' => $reportLog->getLogLevel() ?? LogLevel::DETECTED,
			'port' => $reportLog->getPort(),
			'protocol' => $reportLog->getProtocol(),
			'hostname' => $reportLog->getHostname()
		];

		if(($reportLog->getLogLevel() ?? LogLevel::DETECTED) === LogLevel::DETECTED) {
			return $export;
		}

		$export = array_merge($export, [
			'startedAt' => $reportLog->getStartedAt(),
			'endedAt' => $reportLog->getEndedAt(),
			'type' => $reportLog->getType(),
			'stageType' => $reportLog->getStageType(),
			'activeDataCollectionRules' => [],
			'path' => $reportLog->getPath(),
			'method' => $reportLog->getMethod(),
			'url' => $reportLog->getUrl(),
			'requestHeaders' => $reportLog->getRequestHeaders(),
			'responseHeaders' => $reportLog->getResponseHeaders(),
			'statusCode' => $reportLog->getStatusCode(),
			'requestBody' => $reportLog->getRequestBody(),
			'responseBody' => $reportLog->getResponseBody(),
			'responseBodyPayloadSha' => $reportLog->getResponseBodyPayloadSha(),
			'requestBodyPayloadSha' => $reportLog->getRequestBodyPayloadSha(),
			'errorCode' => $reportLog->getErrorCode(),
			'errorFullMessage' => $reportLog->getErrorFullMessage()
		]);

		foreach ($reportLog->getActiveDataCollectionRules() ?? [] as $i => $dataCollectionRule) {
			$export['activeDataCollectionRules'][$i] = (new DataCollectionRuleSerializer())($dataCollectionRule);
		}

		return $export;
	}
}
