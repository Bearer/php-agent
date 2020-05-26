<?php

namespace Bearer\Sh\Request\Chunk;

/**
 * Class LastChunk
 * @package Bearer\Sh\Request\Chunk
 */
class LastChunk extends DataChunk
{
	/**
	 * @return bool
	 */
	public function isLast(): bool
	{
		return true;
	}
}
