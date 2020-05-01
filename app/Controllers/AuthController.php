<?php

namespace App\Controllers;

use App\Utilities\Request\ResponseCodes;
use Exception;

class AuthController extends BaseController
{
    /**
     * Render login page of the application
     *
     * @return mixed
     * @throws Exception
     */
    public function actionLoginGet()
    {
        $responseStatus = null;
        $html = null;
        try {
            $responseStatus = ResponseCodes::HTTP_OK;
            $html = getViewHtml('login');
        } catch (Exception $exception) {
            list($responseStatus, $html) = parent::errorViewAndCode();
            parent::log($exception);
        }
        // send response
        return [$responseStatus, $html];
    }
}
