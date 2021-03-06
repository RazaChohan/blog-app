<?php

/***
 * Change snake case to camel case
 *
 * @param $string
 * @return mixed
 */
function snakeCaseToCamelCase($string)
{
    if(!empty($string)) {
        $string = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
    }
    return $string;
}

/***
 * Get php suffix
 *
 * @return string
 */
function PHPSuffix() {
    return '.php';
}

/***
 * Get controller suffix
 *
 * @return string
 */
function controllerSuffix() {
    return 'Controller';
}
/***
 * Get status code message
 *
 * @param $status
 * @return mixed|string
 */
function getStatusCodeMessage($status) {
    $codes = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => '(Unused)',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported'
    ];

    return (isset($codes[$status])) ? $codes[$status] : '';
}

/***
 * Get view html
 *
 * @param $fileName
 * @param array $data
 * @return string
 */
function getViewHtml($fileName, $data = []) {
    $filePath = getFolderPath('View'). "/" . $fileName . PHPSuffix();
    ob_start();
    include $filePath;
    return ob_get_clean();
}

/***
 * Get folder path
 *
 * @param $type
 * @return string|null
 */
function getFolderPath($type)
{
    $folderPath = 'app/';
    switch ($type) {
        case 'View':
            $folderPath .= 'Views';
            break;
        case 'Controller':
            $folderPath .= 'Controllers';
            break;
        default:
            $folderPath = '';
    }
    return $folderPath;
}

/***
 * Calculate offset
 *
 * @param $page
 * @param $limit
 * @return float|int
 */
function calculateOffset($page, $limit)
{
    return ($page - 1) * $limit;
}

/***
 * is user authenticated
 *
 * @return bool
 */
function isUserAuthenticated()
{
    return isset($_SESSION['user']);
}

/***
 * Get hashed value
 *
 * @param $string
 * @return string
 */
function getHashedValue($string)
{
    return sha1(md5($string));
}

/***
 * @param $url
 */
function redirect($url)
{
    header('Location: ' . $url, true);
    exit();
}