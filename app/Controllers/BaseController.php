<?php

namespace App\Controllers;

use App\Utilities\Request\ResponseCodes;
use Exception;

class BaseController
{
    /**
     * log exception
     *
     * @param Exception $exception
     */
    protected function log(Exception $exception) {
        error_log($exception);
    }

    /***
     * Error view and status code
     *
     * @return array
     */
    protected function errorViewAndCode() {
        return [ResponseCodes::HTTP_INTERNAL_SERVER_ERROR, getViewHtml('error')];
    }
}