<?php

namespace Bearer\Sh\Handler\Multi;

use Bearer\Sh\Request\CurlRequest;
use Bearer\Sh\Handler\AbstractHandler;
use Bearer\Sh\DataStorage\CurlDataStorage;

/**
 * Class MultiSetOptHandler
 * @package Bearer\Sh\Handler\Multi
 */
class MultiSetOptHandler extends AbstractHandler
{
    /**
     * @return string
     */
    public static function getMethod(): string
    {
        return 'curl_multi_setopt';
    }

    /**
     * @param resource $mh
     * @param string $option
     * @param mixed $value
     * @return mixed
     */
    public function __invoke($mh, $option, $value)
    {
    	CurlRequest::get($mh)->addOptions([$option => $value]);
        return base_curl_multi_setopt($mh, $option, $value);
    }
}
