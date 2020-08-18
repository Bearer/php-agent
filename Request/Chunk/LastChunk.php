<?php

namespace Bearer\Request\Chunk;

/**
 * Class LastChunk
 * @package Bearer\Request\Chunk
 */
class LastChunk extends DataChunk
{
	/**
	 * @return bool
	 */
	public function isLast()
	{
		return true;
	}
}
