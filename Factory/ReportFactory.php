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
	public function __invoke(CurlRequest $request): Report
	{
		$report = new Report();

		$report->setSecretKey(Configuration::get()->getSecretKey());
		$report->setAppEnvironment(Configuration::get()->getEnvironment());
		$report->setAgent((new AgentFactory())());
		$report->setRuntime((new RuntimeFactory())());

		$report->setLogs([
			(new ReportLogFactory())($request)
		]);

		return $report;
	}
}
