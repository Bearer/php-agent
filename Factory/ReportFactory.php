<?php

namespace Bearer\Sh\Factory;

use Bearer\Sh\Model\Configuration;
use Bearer\Sh\Model\Report;
use Bearer\Sh\Request\CurlRequest;

/**
 * Class ReportFactory
 * @package Bearer\Sh\Factory
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
