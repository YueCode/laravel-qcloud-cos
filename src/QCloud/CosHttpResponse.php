<?php
/**
 * Created by PhpStorm.
 * User: lewis
 * Date: 2019/3/31
 * Time: 22:12
 */

namespace YueCode\Cos\QCloud;


class CosHttpResponse
{
    public $curlErrorCode;    // int: curl last error code.
    public $curlErrorMessage; // string: curl last error message.
    public $statusCode;       // int: http status code.
    public $headers;          // array: response headers.
    public $body;             // string: response body.
}