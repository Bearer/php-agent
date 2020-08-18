<?php

namespace Bearer\Request\Chunk;

/**
 * Class DataChunk
 * @package Bearer\Request\Chunk
 */
class DataChunk implements ChunkInterface
{
	/**
	 * @var int
	 */
	private $offset = 0;

	/**
	 * @var string
	 */
	private $content = '';

	/**
	 * DataChunk constructor.
	 * @param int $offset
	 * @param string $content
	 */
	public function __construct($offset = 0, $content = '')
	{
		$this->offset = $offset;
		$this->content = $content;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isTimeout()
	{
		return false;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isFirst()
	{
		return false;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isLast()
	{
		return false;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getInformationalStatus()
	{
		return null;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getOffset()
	{
		return $this->offset;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getError()
	{
		return null;
	}
}
