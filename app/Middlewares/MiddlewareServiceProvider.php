<?php

namespace App\Middlewares;
use App\Utilities\Request\Request;

/***
 * Middleware Service provider applies a one or more
 * middlewares of a specific route
 *
 * Class MiddlewareServiceProvider
 */

class MiddlewareServiceProvider implements IMiddleware
{
    /***
     * Middleware constant
     */
    const MIDDLEWARE = 'Middleware';
    /***
     * Middleware namespace constant for middleware instantiation
     */
    const MIDDLEWARE_NAMESPACE = '\Middlewares\\';
    /***
     * Middleware folder
     */
    const MIDDLEWARE_FOLDER = 'Middlewares/';
    /***
     * Request object containing all the params of request
     *
     * @var Request
     */
    private $request;
    /***
     * Comma Middlewares that should be applied on the request
     *
     * @var array
     */
    private $middlewares;

    /***
     * MiddlewareServiceProvider constructor.
     *
     * @param $middlewares
     * @param $request
     */
    public function __construct($middlewares, &$request)
    {
        $this->request = $request;
        $this->middlewares = explode(',', $middlewares);
    }

    /***
     * Execute middlewares passed
     *
     */
    public function handle()
    {
        if(count($this->middlewares) > 0) {
            foreach($this->middlewares as $middleware) {
                $middleware = snakeCaseToCamelCase($middleware) . MiddlewareServiceProvider::MIDDLEWARE;
                $middleware = MiddlewareServiceProvider::MIDDLEWARE_NAMESPACE . $middleware;
                $middlewareObj = new $middleware($this->request);
                $middlewareObj->handle();
            }
        }
    }
}