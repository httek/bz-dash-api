<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['middleware' => null], function () use ($router) {
    $router->group(['prefix' => 'setting', 'namespace' => 'Setting'], function () use ($router) {
        $router->group(['prefix' => 'roles'], function () use ($router) {
            $router->get('', 'RoleController@index');
            $router->get('{id:\d+}', 'RoleController@show');
            $router->post('', 'RoleController@store');
            $router->post('{id:\d+}', 'RoleController@update');
            $router->delete('{id:\d+}', 'RoleController@destroy');
        });

        $router->group(['prefix' => 'admins'], function () use ($router) {
            $router->get('', 'AdminController@index');
            $router->get('{id:\d+}', 'AdminController@show');
            $router->post('', 'AdminController@store');
            $router->post('{id:\d+}', 'AdminController@update');
            $router->delete('{id:\d+}', 'AdminController@destroy');
        });

        $router->group(['prefix' => 'permissions'], function () use ($router) {
            $router->get('', 'PermissionController@index');
            $router->get('tree', 'PermissionController@tree');
            $router->get('{id:\d+}', 'PermissionController@show');
            $router->post('', 'PermissionController@store');
            $router->post('{id:\d+}', 'PermissionController@update');
            $router->delete('{id:\d+}', 'PermissionController@destroy');
        });
    });

});
