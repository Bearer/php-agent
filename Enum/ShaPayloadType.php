<?php

namespace Bearer\Enum;

/**
 * Class ShaPayloadType
 * @package Bearer\Enum
 */
class ShaPayloadType extends Enum
{
	const OBJECT = 0;
	const ARRAY = 1;
	const STRING = 2;
	const NUMBER = 3;
	const BOOLEAN = 4;
	const NULL = 5;
}
