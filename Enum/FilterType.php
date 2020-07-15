<?php

namespace Bearer\Enum;

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
    const REQUEST_BODY = 'RequestBodyFilter';
    const REQUEST_BODY_SIZE = 'RequestBodySizeFilter';
    // Response
    const RESPONSE_HEADER = 'ResponseHeaderFilter';
	const RESPONSE_BODY = 'ResponseBodyFilter';
	const RESPONSE_BODY_SIZE = 'ResponseBodySizeFilter';
    const STATUS_CODE = 'StatusCodeFilter';
    // Error
    const CONNECTION_ERROR = 'ConnectionErrorFilter';
}
