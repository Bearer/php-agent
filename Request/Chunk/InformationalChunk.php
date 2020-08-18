<?php

namespace Bearer\Request\Chunk;

/**
 * Class InformationalChunk
 * @package Bearer\Request\Chunk
 */
class InformationalChunk extends DataChunk
{
	/**
	 * @var array
	 */
	private $status;

	/**
	 * InformationalChunk constructor.
	 * @param int $statusCode
	 * @param array $headers
	 */
	public function __construct($statusCode, $headers)
	{
		$this->status = [$statusCode, $headers];
		parent::__construct();
	}

	/**
	 * @return array|null
	 */
	public function getInformationalStatus()
	{
		return $this->status;
	}
}
