<?php

namespace Bearer\Async;

use Spatie\Async\Task;

/**
 * Class Pool
 * @package Bearer\Async
 */
class Pool extends \Spatie\Async\Pool
{
    /**
     * @return bool
     */
    public function isStopped(): bool
    {
        return $this->stopped;
    }
}
