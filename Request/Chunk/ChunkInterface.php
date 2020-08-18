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
	public function isTimeout();

	/**
	 * Tells when headers just arrived.
	 *
	 * @throws \RuntimeException on a network error or when the idle timeout is reached
	 */
	public function isFirst();

	/**
	 * Tells when the body just completed.
	 *
	 * @throws \RuntimeException on a network error or when the idle timeout is reached
	 */
	public function isLast();

	/**
	 * Returns a [status code, headers] tuple when a 1xx status code was just received.
	 *
	 * @throws \RuntimeException on a network error or when the idle timeout is reached
	 */
	public function getInformationalStatus();

	/**
	 * Returns the content of the response chunk.
	 *
	 * @throws \RuntimeException on a network error or when the idle timeout is reached
	 */
	public function getContent();

	/**
	 * Returns the offset of the chunk in the response body.
	 */
	public function getOffset();

	/**
	 * In case of error, returns the message that describes it.
	 */
	public function getError();
}
