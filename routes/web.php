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
    return 'Manos vacias API. Corregir';
});

$router->post('users/login', 'UserController@login');
$router->post('users', 'UserController@store');
$router->get('users', 'UserController@index');
$router->get('users/{id}', 'UserController@show');
$router->post('users/{id}', 'UserController@update');
$router->post('users/eliminar/{id}', 'UserController@destroy');

$router->post('roles', 'RolController@store');
$router->get('roles', 'RolController@index');
$router->get('roles/{id}', 'RolController@show');
$router->post('roles/{id}', 'RolController@update');
$router->post('roles/eliminar/{id}', 'RolController@destroy');

$router->post('representantes', 'RepresentanteController@store');
$router->get('representantes', 'RepresentanteController@index');
$router->get('representantes/{id}', 'RepresentanteController@show');
$router->post('representantes/{id}', 'RepresentanteController@update');
$router->post('representantes/eliminar/{id}', 'RepresentanteController@destroy');

$router->get('representantes/{id}/ninhos', 'RepresentanteController@indexNinhos');

$router->post('ninhos', 'NinhoController@store');
$router->get('ninhos', 'NinhoController@index');
$router->get('ninhos/{id}', 'NinhoController@show');
$router->post('ninhos/{id}', 'NinhoController@update');
$router->post('ninhos/eliminar/{id}', 'NinhoController@destroy');

$router->get('ninhos/{id}/cancer', 'NinhoController@indexCancer');
$router->post('ninhos/{id}/cancer', 'NinhoController@storeCancer');
$router->post('ninhos/{id}/cancer/{id_cancer}', 'NinhoController@updateCancer');
$router->post('ninhos/{id}/cancer/eliminar/{id_cancer}', 'NinhoController@destroyCancer');

$router->get('ninhos/{id}/requerimientos', 'NinhoController@indexRequerimientos');

$router->post('requerimientos', 'RequerimientoController@store');
$router->get('requerimientos', 'RequerimientoController@index');
$router->get('requerimientos/{id}', 'RequerimientoController@show');
$router->post('requerimientos/{id}', 'RequerimientoController@update');
$router->post('requerimientos/eliminar/{id}', 'RequerimientoController@destroy');

$router->post('cancer', 'CancerController@store');
$router->get('cancer', 'CancerController@index');
$router->get('cancer/{id}', 'CancerController@show');
$router->post('cancer/{id}', 'CancerController@update');
$router->post('cancer/eliminar/{id}', 'CancerController@destroy');

$router->post('adjuntos', 'AdjuntoController@store');
$router->get('adjuntos', 'AdjuntoController@index');
$router->get('adjuntos/{id}', 'AdjuntoController@show');
$router->post('adjuntos/{id}', 'AdjuntoController@update');
$router->post('adjuntos/eliminar/{id}', 'AdjuntoController@destroy');

$router->post('estados', 'EstadoController@store');
$router->get('estados', 'EstadoController@index');
$router->get('estados/{id}', 'EstadoController@show');
$router->post('estados/{id}', 'EstadoController@update');
$router->post('estados/eliminar/{id}', 'EstadoController@destroy');

$router->post('municipios', 'MunicipioController@store');
$router->get('municipios', 'MunicipioController@index');
$router->get('municipios/{id}', 'MunicipioController@show');
$router->post('municipios/{id}', 'MunicipioController@update');
$router->post('municipios/eliminar/{id}', 'MunicipioController@destroy');

$router->post('tipos', 'TipoController@store');
$router->get('tipos', 'TipoController@index');
$router->get('tipos/{id}', 'TipoController@show');
$router->post('tipos/{id}', 'TipoController@update');
$router->post('tipos/eliminar/{id}', 'TipoController@destroy');