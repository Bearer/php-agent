<?php

namespace Bearer\Enum;

/**
 * Class StageType
 */
class StageType extends Enum
{
    const CONNECT = 'ConnectStage';
    const REQUEST = 'RequestStage';
    const RESPONSE = 'ResponseStage';
    const BODIES = 'BodiesStage';
}
