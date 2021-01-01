<?php

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

use App\Http\Middleware\HelloMiddleware;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('hello/','HelloController@index')->middleware(HelloMiddleware::class);
Route::get('hello/','HelloController@index')->middleware(HelloMiddleware::class)->middleware('auth');
// Route::get('hello/{id?}','HelloController@index');
// Route::get('hello/{id?}','HelloController@index')->middleware('hello');
Route::post('hello/','HelloController@post');

Route::get('hello/request', 'HelloController@request');
Route::get('hello/other', 'HelloController@other');
Route::get('hello/add', 'HelloController@add');
Route::post('hello/add', 'HelloController@create');
Route::get('hello/edit', 'HelloController@edit');
Route::post('hello/edit', 'HelloController@update');
Route::get('hello/del', 'HelloController@del');
Route::post('hello/del', 'HelloController@remove');
Route::get('hello/show', 'HelloController@show');
Route::get('person', 'PersonController@index');
Route::get('person/find', 'PersonController@find');
Route::post('person/find', 'PersonController@search');
Route::get('person/add', 'PersonController@add');
Route::post('person/add', 'PersonController@create');
Route::get('person/edit', 'PersonController@edit');
Route::post('person/edit', 'PersonController@update');
Route::get('person/del', 'PersonController@delete');
Route::post('person/del', 'PersonController@remove');
Route::get('board', 'BoardController@index');
Route::get('board/add', 'BoardController@add');
Route::post('board/add', 'BoardController@create');
Route::get('hello/rest', 'HelloController@rest');
Route::get('hello/session', 'HelloController@ses_get');
Route::post('hello/session', 'HelloController@ses_put');
Route::get('hello/auth', 'HelloController@getAuth');
Route::post('hello/auth', 'HelloController@postAuth');

Route::resource('rest', 'RestappController');

Route::get('hello2/{msg?}', function($msg='no') {
    $html = <<<EOF
<html>
<head>
<title>Hello</title>
</head>
<style>
body {font-size:16pt; color:#999}
h1 {font-size:100pt; text-align:right; color:#eee; margin:-40px 0px -50px 0px;}
</style>
<body>
    <h1>Hello</h1>
    <p>{$msg}</p>
    <p>This is sample page.</p>
    <p>これは、サンプルで作ったページです。</p>
</body>
</html>
EOF;

    return $html;
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
