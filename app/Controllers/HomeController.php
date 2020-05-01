<?php


namespace App\Controllers;

use App\Models\Blog;
use App\Utilities\Request\Request;
use App\Utilities\Request\ResponseCodes;
use Exception;

class HomeController extends BaseController
{
    /***
     * main get action method
     *
     * @param Request $request
     *
     * @return array
     */
    public function actionMainGet(Request $request)
    {
        $responseStatus = null;
        $html = null;
        try {
            $page = $request->getQueryParams()->get('page', 1);
            $blogModel = new Blog();
            $responseStatus = ResponseCodes::HTTP_OK;
            $html = getViewHtml('main', ['blogs' => $blogModel->getBlogs($page, 1)]);
        } catch (Exception $exception) {
            list($responseStatus, $html) = parent::errorViewAndCode();
            parent::log($exception);
        }
        // send response
        return [$responseStatus, $html];
    }
}