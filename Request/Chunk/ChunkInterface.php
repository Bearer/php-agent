<?php

namespace Bearer\Request\Chunk;

/**
 * Interface ChunkInterface
 * @package Bearer\Request\Chunk
 */
interface ChunkInterface
{
	/**
	 * Tells when the idle timeout has been reached.
	 *
	 * @throws \RuntimeException on a network error
	 */
	public function isTimeout(): bool;

	/**
	 * Tells when headers just arrived.
	 *
	 * @throws \RuntimeException on a network error or when the idle timeout is reached
	 */
	public function isFirst(): bool;

	/**
	 * Tells when the body just completed.
	 *
	 * @throws \RuntimeException on a network error or when the idle timeout is reached
	 */
	public function isLast(): bool;

	/**
	 * Returns a [status code, headers] tuple when a 1xx status code was just received.
	 *
	 * @throws \RuntimeException on a network error or when the idle timeout is reached
	 */
	public function getInformationalStatus(): ?array;

	/**
	 * Returns the content of the response chunk.
	 *
	 * @throws \RuntimeException on a network error or when the idle timeout is reached
	 */
	public function getContent(): string;

	/**
	 * Returns the offset of the chunk in the response body.
	 */
	public function getOffset(): int;

	/**
	 * In case of error, returns the message that describes it.
	 */
	public function getError(): ?string;
}
