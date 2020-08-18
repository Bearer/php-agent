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
	public function __invoke($report)
	{
		$runtime = new RuntimeSerializer();
		$agent = new AgentSerializer();

		$export = [
			'secretKey' => $report->getSecretKey(),
			'appEnvironment' => $report->getAppEnvironment(),
			'runtime' => $runtime($report->getRuntime()),
			'agent' => $agent($report->getAgent()),
			'logs' => []
		];

		$serializer = new ReportLogSerializer();
		foreach ($report->getLogs() !== null ? $report->getLogs() : [] as $i => $log) {
			$export['logs'][$i] = $serializer($log);
		}

		return $export;
	}
}
