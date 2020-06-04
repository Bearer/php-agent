<?php

namespace Bearer\Handler;

use Bearer\Request\CurlRequest;
use Bearer\DataStorage\CurlDataStorage;

/**
 * Class SetOptHandler
 * @package Bearer\Handler
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
