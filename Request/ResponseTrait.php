<?php

namespace Bearer\Sh\Request;

use Bearer\Sh\Request\Chunk\DataChunk;
use Bearer\Sh\Request\Chunk\ErrorChunk;
use Bearer\Sh\Request\Chunk\FirstChunk;
use Bearer\Sh\Request\Chunk\InformationalChunk;
use Bearer\Sh\Request\Chunk\LastChunk;
use Bearer\Sh\Exception\TransportException;

/**
 * Trait ResponseTrait
 * @package Bearer\Sh\Curl
 */
trait ResponseTrait
{

	/**
	 * @var array
	 */
	protected $headers = [];

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
	private $inflate;

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
	 * @param resource $ch
	 * @param string $data
	 */
	public function addHeader($ch, string $data): void
	{
		if ($this->http_method === null) {
			$this->http_method = $this->request->getOptions()[CURLOPT_CUSTOMREQUEST] ?? null;
		}

		if ("\r\n" !== $data) {
			$local_headers = [substr($data, 0, -2)];
			foreach ($local_headers as $h) {
				if (11 <= \strlen($h) && '/' === $h[4] && preg_match('#^HTTP/\d+(?:\.\d+)? ([12345]\d\d)(?: |$)#', $h, $m)) {
					if ($local_headers) {
						$local_headers = [];
					}
					$this->http_code = (int)$m[1];
				} elseif (2 === \count($m = explode(':', $h, 2))) {
					$local_headers[strtolower($m[0])][] = ltrim($m[1]);
				}

				$this->headers[] = $h;
			}

			if ($this->http_code === null) {
				throw new \RuntimeException('Invalid or missing HTTP status line.');
			}

			if (0 !== strpos($data, 'HTTP/')) {
				return;
			}

			if (
				303 === $this->http_code || (
					'POST' === $this->http_method && \in_array($this->http_code, [301, 302], true)
				)
			) {
				$this->http_method = 'HEAD' === $this->http_method ? 'HEAD' : 'GET';
			}
		}


		if (200 > $this->http_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE)) {
			$this->addData(new InformationalChunk($this->http_code, $this->headers));
			$this->location = null;

			return;
		}

		if ($this->http_code < 300 || 400 <= $this->http_code || null === $this->location) {
			// Headers and redirects completed, time to get the response's content
			$this->addData(new FirstChunk());

			if ('HEAD' === $this->http_method || \in_array($this->http_code, [204, 304], true)) {
				$this
					->addData(null)
					->addData(null);
			}
		}
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

		if(is_resource($this->content)) {
			foreach ($this->stream() as $chunk) {
				// Chunks are buffered in $this->content already
			}

			rewind($this->content);

			return stream_get_contents($this->content);
		}

		return $this->content;
	}

	/**
	 * @param null $content
	 */
	public function setContent($content): void
	{
		$this->content = $content;
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
				$this->inflate = \extension_loaded('zlib') && in_array('content-encoding: gzip', $this->headers) ? inflate_init(ZLIB_ENCODING_GZIP) : null;

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
