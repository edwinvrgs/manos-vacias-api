<?php

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

$router->post('users/login', 'UserController@login');
$router->post('users', 'UserController@store');
$router->get('users', 'UserController@index');
$router->get('users/{id}', 'UserController@show');
$router->put('users/{id}', 'UserController@update');
$router->delete('users/{id}', 'UserController@destroy');

$router->post('roles', 'RolController@store');
$router->get('roles', 'RolController@index');
$router->get('roles/{id}', 'RolController@show');
$router->put('roles/{id}', 'RolController@update');
$router->delete('roles/{id}', 'RolController@destroy');

$router->post('representantes', 'RepresentanteController@store');
$router->get('representantes', 'RepresentanteController@index');
$router->get('representantes/{id}', 'RepresentanteController@show');
$router->put('representantes/{id}', 'RepresentanteController@update');
$router->delete('representantes/{id}', 'RepresentanteController@destroy');

$router->post('niños', 'NiñoController@store');
$router->get('niños', 'NiñoController@index');
$router->get('niños/{id}', 'NiñoController@show');
$router->put('niños/{id}', 'NiñoController@update');
$router->delete('niños/{id}', 'NiñoController@destroy');

$router->post('requerimientos', 'RequerimientoController@store');
$router->get('requerimientos', 'RequerimientoController@index');
$router->get('requerimientos/{id}', 'RequerimientoController@show');
$router->put('requerimientos/{id}', 'RequerimientoController@update');
$router->delete('requerimientos/{id}', 'RequerimientoController@destroy');

$router->post('cancer', 'CancerController@store');
$router->get('cancer', 'CancerController@index');
$router->get('cancer/{id}', 'CancerController@show');
$router->put('cancer/{id}', 'CancerController@update');
$router->delete('cancer/{id}', 'CancerController@destroy');

$router->post('adjuntos', 'AdjuntoController@store');
$router->get('adjuntos', 'AdjuntoController@index');
$router->get('adjuntos/{id}', 'AdjuntoController@show');
$router->put('adjuntos/{id}', 'AdjuntoController@update');
$router->delete('adjuntos/{id}', 'AdjuntoController@destroy');

$router->post('estados', 'EstadoController@store');
$router->get('estados', 'EstadoController@index');
$router->get('estados/{id}', 'EstadoController@show');
$router->put('estados/{id}', 'EstadoController@update');
$router->delete('estados/{id}', 'EstadoController@destroy');

$router->post('municipios', 'MunicipioController@store');
$router->get('municipios', 'MunicipioController@index');
$router->get('municipios/{id}', 'MunicipioController@show');
$router->put('municipios/{id}', 'MunicipioController@update');
$router->delete('municipios/{id}', 'MunicipioController@destroy');

$router->post('tipos', 'TipoController@store');
$router->get('tipos', 'TipoController@index');
$router->get('tipos/{id}', 'TipoController@show');
$router->put('tipos/{id}', 'TipoController@update');
$router->delete('tipos/{id}', 'TipoController@destroy');