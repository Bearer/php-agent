<?php

namespace Bearer\Sh\Request\Chunk;

/**
 * Class InformationalChunk
 * @package Bearer\Sh\Request\Chunk
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
	public function __construct(int $statusCode, array $headers)
	{
		$this->status = [$statusCode, $headers];
	}

	/**
	 * @return array|null
	 */
	public function getInformationalStatus(): ?array
	{
		return $this->status;
	}
}
