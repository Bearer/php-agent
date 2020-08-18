<?php

namespace Bearer\Factory;

use Bearer\Model\Configuration;
use Bearer\Model\Report;
use Bearer\Request\CurlRequest;

/**
 * Class ReportFactory
 * @package Bearer\Factory
 */
class ReportFactory
{
	/**
	 * @param CurlRequest $request
	 * @return Report
	 */
	public function __invoke($request)
	{
		$report = new Report();

		$agent = new AgentFactory();
		$runtime = new RuntimeFactory();
		$reportLog = new ReportLogFactory();

		$report->setSecretKey(Configuration::get()->getSecretKey());
		$report->setAppEnvironment(Configuration::get()->getEnvironment());
		$report->setAgent($agent());
		$report->setRuntime($runtime());

		$report->setLogs([
			$reportLog($request)
		]);

		return $report;
	}
}
