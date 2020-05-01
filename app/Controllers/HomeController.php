<?php


namespace App\Controllers;

use App\Utilities\Request\ResponseCodes;
use Exception;

class HomeController extends BaseController
{
    /***
     * main get action method
     *
     * @return array
     */
    public function actionMainGet()
    {
        $responseStatus = null;
        $html = null;
        try {
            $responseStatus = ResponseCodes::HTTP_OK;
            $html = getViewHtml('main');
        } catch (Exception $exception) {
            list($responseStatus, $html) = parent::errorViewAndCode();
            parent::log($exception);
        }
        // send response
        return [$responseStatus, $html];
    }
}