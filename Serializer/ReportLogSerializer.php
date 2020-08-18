<?php

namespace Bearer\Serializer;

use Bearer\Enum\LogLevel;
use Bearer\Enum\ReportLogType;
use Bearer\Enum\StageType;
use Bearer\Model\ReportLog;

/**
 * Class ReportLogSerializer
 * @package Bearer\Serializer
 */
class ReportLogSerializer
{
	/**
	 * @param ReportLog $reportLog
	 * @return array
	 */
	public function __invoke($reportLog)
	{
		$exports = [
			StageType::CONNECT => [
				'logLevel' => $reportLog->getLogLevel() !== null ? $reportLog->getLogLevel() : LogLevel::DETECTED,
				'port' => $reportLog->getPort(),
				'protocol' => $reportLog->getProtocol(),
				'hostname' => $reportLog->getHostname(),

				'startedAt' => $reportLog->getStartedAt(),
				'endedAt' => $reportLog->getEndedAt(),
				'type' => $reportLog->getType(),
				'stageType' => $reportLog->getStageType(),
				'activeDataCollectionRules' => []
			],
			StageType::INIT => [
				'path' => $reportLog->getPath(),
				'method' => $reportLog->getMethod(),
				'url' => $reportLog->getUrl()
			],
			StageType::REQUEST => [
				'requestHeaders' => $reportLog->getRequestHeaders()
			],
			StageType::RESPONSE => [
				'statusCode' => $reportLog->getStatusCode(),
				'responseHeaders' => $reportLog->getResponseHeaders()
			],
			StageType::BODIES => [
				'requestBody' => $reportLog->getRequestBody(),
				'requestBodyPayloadSha' => $reportLog->getRequestBodyPayloadSha(),
				'responseBody' => $reportLog->getResponseBody(),
				'responseBodyPayloadSha' => $reportLog->getResponseBodyPayloadSha()
			]
		];

		$export = [];
		foreach ($exports as $stage => $stage_export) {
			if (StageType::is($stage, $reportLog->getStageType())) {
				$export += $stage_export;
			}
		}

		foreach ($reportLog->getActiveDataCollectionRules() !== null ? $reportLog->getActiveDataCollectionRules() : [] as $i => $dataCollectionRule) {
			$serializer = new DataCollectionRuleSerializer();
			$export['activeDataCollectionRules'][$i] = $serializer($dataCollectionRule);
		}

		if (($reportLog->getLogLevel() !== null ? $reportLog->getLogLevel() : LogLevel::DETECTED) === LogLevel::DETECTED) {
			return array_filter($export, function ($key) {
				return in_array($key, [
					'logLevel',
					'port',
					'protocol',
					'hostname'
				]);
			}, ARRAY_FILTER_USE_KEY);
		}

		if ($reportLog->getType() === ReportLogType::ERROR) {
			$export += [
				'errorCode' => $reportLog->getErrorCode(),
				'errorFullMessage' => $reportLog->getErrorFullMessage()
			];
		}


		return $export;
	}
}
