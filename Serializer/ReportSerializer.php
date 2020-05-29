<?php

namespace Bearer\Serializer;

use Bearer\Model\Report;

/**
 * Class ReportSerializer
 * @package Bearer\Serializer
 */
class ReportSerializer
{
	/**
	 * @param Report $report
	 * @return array
	 */
	public function __invoke(Report $report): array
	{
		$export = [
			'secretKey' => $report->getSecretKey(),
			'appEnvironment' => $report->getAppEnvironment(),
			'runtime' => (new RuntimeSerializer())($report->getRuntime()),
			'agent' => (new AgentSerializer())($report->getAgent()),
			'logs' => []
		];

		foreach ($report->getLogs() ?? [] as $i => $log) {
			$export['logs'][$i] = (new ReportLogSerializer())($log);
		}

		return $export;
	}
}
