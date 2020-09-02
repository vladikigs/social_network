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
        return view("welcome");
});

Route::get('/profile', function()
{
    if (Auth::user() != null) {
        return redirect()->action('ProfileController@index', ['id' => Auth::user()->id]);
    }
    else{
        return view("welcome");
    }
});

Route::get('/profile/{id}', 'ProfileController@index');

Route::match(['get', 'post'], '/addComment/{userPageId}', 'CommentController@addComment');

Route::get('/deleteAllComments', 'CommentController@deleteAllComments');

Route::get('/deleteComment/{idComment}/{idPageRefrash}', 'CommentController@deleteComment');

Route::get('/loadMoreComments/{lastCommentNum}/{idUserPage}', 'CommentController@loadMoreComments');
// Route::get('/home/{name?}', function ($name) {
//     echo $name;
//   });
