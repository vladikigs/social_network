<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile/{id}', 'ProfileController@index');

Route::match(['get', 'post'], '/addComment/{userPageId}', 'CommentController@form');


// Route::get('/home/{name?}', function ($name) {
//     echo $name;
//   });
