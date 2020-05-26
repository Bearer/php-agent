<?php

namespace Bearer\Sh\Async;

use Spatie\Async\Task;

/**
 * Class Pool
 * @package Bearer\Sh\Async
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
