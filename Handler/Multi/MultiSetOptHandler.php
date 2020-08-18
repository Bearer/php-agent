<?php

namespace Bearer\Handler\Multi;

use Bearer\Request\CurlRequest;
use Bearer\Handler\AbstractHandler;

/**
 * Class MultiSetOptHandler
 * @package Bearer\Handler\Multi
 */
class MultiSetOptHandler extends AbstractHandler
{

    /**
     * @param resource $mh
     * @param string $option
     * @param mixed $value
     * @return mixed
     */
    public static function run($mh, $option, $value)
    {
    	CurlRequest::get($mh)->addOptions([$option => $value]);
        return curl_multi_setopt($mh, $option, $value);
    }
}
