<?php

namespace Bearer\Factory;

use Bearer\Model\RegularExpression;

/**
 * Class RegularExpressionFactory
 * @package Bearer\Factory
 */
class RegularExpressionFactory
{
    /**
     * @param array $data
     * @return RegularExpression
     */
    public function __invoke(array $data): RegularExpression
    {
        $regEx = new RegularExpression();

        $regEx->setValue($data['value']);
        $regEx->setFlags($data['flags']);

        return $regEx;
    }
}
