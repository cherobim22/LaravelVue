<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
$router->get('/polls/{id}', 'App\Http\Controllers\PollController@getPoll');
$router->get('/polls', 'App\Http\Controllers\PollController@buscarTodos');
$router->get('/options', 'App\Http\Controllers\OptionController@buscarTodos');
$router->get('/options/{id}', 'App\Http\Controllers\OptionController@getPoll');
$router->get('polll/status/{id}', 'App\Http\Controllers\PollController@getStatus');

Route::post('/poll', 'App\Http\Controllers\PollController@create');



