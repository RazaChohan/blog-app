<?php
/**
 * Defines all routes that Router will map using alto Router.
 *
 * Sample route
 *
 * 'controller.action_method' => [
 *                                   'method'      => 'GET',
 *                                   'path'       => 'sample_route',
 *                                   'Middlewares' => [
 *                                                          'pre' => 'middleware1',
 *                                                          'post' => 'middleware2'
 *                                                    ]
 *                               ]
 */
namespace Router;

use App\Middlewares\MiddlewareType;

return [
    // route for get login page
    'Home.mainGet' => [
        'method'       => 'GET',
        'path'         => '/',
        'Middlewares'  => [
            MiddlewareType::PRE   => '',
            MiddlewareType::POST => ''
        ]
    ],
    // route for get login page
    'Auth.loginGet' => [
        'method'       => 'GET',
        'path'         => '/login',
        'Middlewares'  => [
            MiddlewareType::PRE   => '',
            MiddlewareType::POST => ''
        ]
    ],

];