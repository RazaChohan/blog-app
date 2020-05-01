<?php
namespace App\Utilities\Request;

/***
 * Response codes (ENUM)
 *
 * Class ResponseCodes
 */
abstract class ResponseCodes
{
    const HTTP_OK = 200;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_NOT_FOUND = 404;
    const HTTP_INTERNAL_SERVER_ERROR = 500;
}