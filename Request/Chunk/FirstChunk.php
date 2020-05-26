<?php

namespace Bearer\Sh\Request\Chunk;

/**
 * Class FirstChunk
 * @package Bearer\Sh\Request\Chunk
 */
class FirstChunk extends DataChunk
{
	/**
	 * @return bool
	 */
	public function isFirst(): bool
	{
		return true;
	}
}
