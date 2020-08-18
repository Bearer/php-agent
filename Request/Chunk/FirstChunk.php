<?php

namespace Bearer\Request\Chunk;

/**
 * Class FirstChunk
 * @package Bearer\Request\Chunk
 */
class FirstChunk extends DataChunk
{
	/**
	 * @return bool
	 */
	public function isFirst()
	{
		return true;
	}
}
