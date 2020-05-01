<?php

namespace App\Controllers;

use App\Models\User;
use App\Utilities\Request\Request;
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
    /**
     * login Post method
     *
     * @param $request
     * @return mixed
     * @throws Exception
     */
    public function actionLoginPost(Request $request)
    {
        $responseStatus = null;
        $html = null;
        try {
            $username = $request->getPostParams()->get('username');
            $password = $request->getPostParams()->get('password');
            $userModel = new User();
            $user = $userModel->getUser($username, $password);
            if(is_null($userModel->getUser($username, $password))) {
                redirect('/login');
            } else {
                $_SESSION['user'] = $user;
                redirect('/');
            }
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
