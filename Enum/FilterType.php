<?php

namespace Bearer\Sh\Enum;

/**
 * Class FilterType
 */
class FilterType extends Enum
{
    // Structural
    const NOT = 'NotFilter';
    const FILTER_SET = 'FilterSet';
    // Connection
    const DOMAIN = 'DomainFilter';
    // Request
    const HTTP_METHOD = 'HttpMethodFilter';
    const PATH = 'PathFilter';
    const PARAM = 'ParamFilter';
    const REQUEST_HEADER = 'RequestHeaderFilter';
    // Response
    const RESPONSE_HEADER = 'ResponseHeaderFilter';
    const STATUS_CODE = 'StatusCodeFilter';
    // Error
    const CONNECTION_ERROR = 'ConnectionErrorFilter';
}
