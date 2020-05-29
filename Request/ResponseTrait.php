<?php

namespace Bearer\Request;

use Bearer\Request\Chunk\DataChunk;
use Bearer\Request\Chunk\ErrorChunk;
use Bearer\Request\Chunk\FirstChunk;
use Bearer\Request\Chunk\LastChunk;
use Bearer\Exception\TransportException;

/**
 * Trait ResponseTrait
 * @package Bearer\Curl
 */
trait ResponseTrait
{
	/**
	 * @var null
	 */
	protected $content = null;

	/**
	 * @var string|null
	 */
	protected $http_method = null;

	/**
	 * @var string|null
	 */
	protected $error = null;

	/**
	 * @var array
	 */
	private $data = [];

	/**
	 * @var null
	 */
	private $inflate = null;

	/**
	 * @var int
	 */
	private $offset = 0;

	/**
	 * @param $data
	 * @return $this
	 */
	public function addData($data): self
	{
		$this->data[] = $data;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getContent(): string
	{
		if ($this->content === null) {
			$content = null;

			foreach ($this->stream() as $chunk) {
				if (!$chunk->isLast()) {
					$content .= $chunk->getContent();
				}
			}

			if (null !== $content) {
				return $content;
			}

			if ('HEAD' === $this->http_method) {
				return '';
			}

			throw new \RuntimeException('Cannot get the content of the response twice: buffering is disabled.');
		}

		foreach ($this->stream() as $chunk) {
			// Chunks are buffered in $this->content already
		}


		rewind($this->content);

		return stream_get_contents($this->content);
	}

	/**
	 * @return \Generator|void
	 */
	private function stream()
	{
		$chunk = false;

		if (!isset($this->data)) {
			return;
		}

		while ($this->data ?? false) {
			if (\is_string($chunk = array_shift($this->data))) {
				if (null !== $this->inflate && false === $chunk = @inflate_add($this->inflate, $chunk)) {
					$this->data = [null, new TransportException('Error while processing content unencoding.')];
					continue;
				}

				if ('' !== $chunk && null !== $this->content && \strlen($chunk) !== fwrite($this->content, $chunk)) {
					$this->data = [null, new TransportException(sprintf('Failed writing %d bytes to the response buffer.', \strlen($chunk)))];
					continue;
				}

				$this->offset += \strlen($chunk);
				$chunk = new DataChunk($this->offset, $chunk);
			} elseif (null === $chunk) {
				$e = $this->data[0];

				if (null !== $e) {
					$this->error = $e->getMessage();

					if ($e instanceof \Error) {
						throw $e;
					}

					$chunk = new ErrorChunk($this->offset, $e);
				} else {
					$chunk = new LastChunk($this->offset);
				}
			} elseif ($chunk instanceof FirstChunk) {
				$this->inflate = \extension_loaded('zlib') && $this->inflate && 'gzip' === ($response->headers['content-encoding'][0] ?? null) ? inflate_init(ZLIB_ENCODING_GZIP) : null;
				$this->content = fopen('php://temp', 'w+');

				yield $this => $chunk;

				continue;
			}

			yield $response => $chunk;
		}

		if ($chunk instanceof ErrorChunk && !$chunk->didThrow()) {
			$chunk->getContent();
		}
	}
}
