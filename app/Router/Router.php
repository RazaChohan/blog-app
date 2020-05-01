<?php

namespace App\Router;

use AltoRouter;
use App\Middlewares\MiddlewareServiceProvider;
use App\Middlewares\MiddlewareType;
use App\Utilities\Request\Request;
use App\Utilities\Request\ResponseCodes;
use Exception;

class Router {
    /***
     * Main router method registering routes
     *
     * @throws Exception
     */
    public function main()
    {
        try {
            $routes = require_once 'routes.php';

            //Initialize Altorouter
            $router = new AltoRouter();

            $router->setBasePath('');

            //Register routes from routes.php file and map them on Alto Router
            $this->registerRoutes($router, $routes);

            //Match coming request with mapped routes using Alto Router
            $match = $router->match();
            if ($match) {

                $request = new Request();
                $request->populate();
                $request->appendQueryParams($match['params']);
                //Get method name from route name/key
                $methodName = $this->getMethodNameFromRouteName($match['name']);

                //Set action method name in request object
                $request->setControllerActionMethod($methodName);

                //Apply pre Middlewares
                $this->callMiddlewares($request, $match['name'], $routes, MiddlewareType::PRE);

                //Require controller
                $this->requireControllerAndCheckMethod($match['target'], $methodName);
                $controllerName = '\App\Controllers\\' . $match['target'] . controllerSuffix();
                $controllerObj = new $controllerName();
                list($status, $body) = $controllerObj->{$methodName}($request);
                //Apply post Middlewares
                $this->callMiddlewares($request, $match['name'], $routes, MiddlewareType::POST);
            } else {//404 not found
                $status = ResponseCodes::HTTP_NOT_FOUND;
                $body = getViewHtml('404');
            }
            // Set HTTP header
            $statusHeader = 'HTTP/1.1 ' . $status . ' ' . getStatusCodeMessage($status);
            header($statusHeader, true, intval($status));

            // Encode json
            echo $body;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /***
     * Register routes on alto Router
     *
     * @param $router AltoRouter
     * @param $routes array
     *
     * @throws
     *
     */
    public function registerRoutes($router, $routes)
    {
        foreach($routes as $key => $route) {

            //Get controller and action method names
            $controllerAndMethod = explode('.', $key);
            $controller = $controllerAndMethod[0];
            $method = $controllerAndMethod[1];
            //Map routes on alto Router
            if(!empty($controller) && !empty($method) && isset($route['path']) && isset($route['method'])) {
                $router->map($route['method'], $route['path'], $controller, $key);
            }
        }
    }

    /***
     * Require controller
     *
     * @param $controllerName
     * @param $methodName
     *
     * @throws Exception
     */
    public function requireControllerAndCheckMethod($controllerName, $methodName)
    {
        $file = getFolderPath('Controller') . '/'. $controllerName . controllerSuffix() . PHPSuffix();
        //Test if the controller file exists - otherwise return Error control
        if (file_exists($file)) {
            $controllerName = '\App\Controllers\\' . $controllerName . 'Controller';
            $controllerObj = new $controllerName();
            if(!method_exists($controllerObj, $methodName)) {
                throw new Exception("Method call {$methodName} does not exist in " . $file);
            }
        } else {
            throw new Exception("Controller file {$file} does not exist");
        }
    }

    /***
     * Call Middlewares
     *
     * @param $request
     * @param $routeKey
     * @param $routes
     * @param $middlewareType
     */
    public function callMiddlewares(&$request, $routeKey, $routes, $middlewareType)
    {
        if( isset($routes[$routeKey]) && isset($routes[$routeKey]['Middlewares'][$middlewareType]) &&
            !empty($routes[$routeKey]['Middlewares'][$middlewareType])) {
            $middleServiceProvider = new MiddlewareServiceProvider($routes[$routeKey]['Middlewares'][$middlewareType], $request);
            $middleServiceProvider->handle();
        }
    }

    /***
     * Get method name from route name (xalerts.GetByUserID => GetByUserID)
     *
     * @param $routeName
     * @return mixed
     */
    public function getMethodNameFromRouteName($routeName)
    {
        $explodedRouteName = explode('.', $routeName);
        return 'action' . ucfirst(end($explodedRouteName));
    }
}