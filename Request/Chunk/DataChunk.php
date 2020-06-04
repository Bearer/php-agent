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
	public function __construct(int $offset = 0, string $content = '')
	{
		$this->offset = $offset;
		$this->content = $content;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isTimeout(): bool
	{
		return false;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isFirst(): bool
	{
		return false;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isLast(): bool
	{
		return false;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getInformationalStatus(): ?array
	{
		return null;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getContent(): string
	{
		return $this->content;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getOffset(): int
	{
		return $this->offset;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getError(): ?string
	{
		return null;
	}
}
