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

$router->get('/', '\App\Http\Controllers\BadgerController@index');
$router->post('/', ['middleware' => 'pass', 'uses'=>'\App\Http\Controllers\BadgerController@save']);
$router->get('/{author}/{repo}/{type}[/{label}]', '\App\Http\Controllers\BadgerController@badge');
