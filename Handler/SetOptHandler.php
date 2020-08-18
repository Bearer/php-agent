<?php

namespace Bearer\Handler;

use Bearer\Request\CurlRequest;

/**
 * Class SetOptHandler
 * @package Bearer\Handler
 */
class SetOptHandler extends AbstractHandler
{

    /**
     * @param resource $ch
     * @param string $option
     * @param mixed $value
     * @return mixed
     */
    public static function run($ch, $option, $value)
    {
        CurlRequest::get($ch)->addOptions([
        	$option => $value
		]);

        return curl_setopt($ch, $option, $value);
    }
}
