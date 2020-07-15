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
     * @return RegularExpression|null
     */
    public function __invoke(?array $data = []): ?RegularExpression
    {
    	if (empty($data) || $data === null) {
    		return null;
		}

        $regEx = new RegularExpression();
    	$regEx->setValue($data['value']);
        $regEx->setFlags($data['flags'] ?? 'i');

        return $regEx;
    }
}
