<?php

namespace Bearer\Sh\Handler;

use Bearer\Sh\Request\CurlRequest;
use Bearer\Sh\DataStorage\CurlDataStorage;

/**
 * Class SetOptHandler
 * @package Bearer\Sh\Handler
 */
class SetOptHandler extends AbstractHandler
{
    /**
     * @return string
     */
    public static function getMethod(): string
    {
        return 'curl_setopt';
    }

    /**
     * @param resource $ch
     * @param string $option
     * @param mixed $value
     * @return mixed
     */
    public function __invoke($ch, $option, $value)
    {
        CurlRequest::get($ch)->addOptions([
        	$option => $value
		]);
        return base_curl_setopt($ch, $option, $value);
    }
}
