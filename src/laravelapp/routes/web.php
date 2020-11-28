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

Route::get('/', function () {
    return view('welcome');
});

Route::get('hello/{id?}','HelloController@index');
Route::post('hello/','HelloController@post');

Route::get('hello/request', 'HelloController@request');
Route::get('hello/other', 'HelloController@other');

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