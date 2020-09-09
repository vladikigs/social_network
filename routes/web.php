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



Route::get('/', 'ProfileController@getUsers');

Route::get('/profile', function()
{
    if (Auth::user() != null) {
        return redirect()->action('ProfileController@index', ['id' => Auth::user()->id]);
    }
    else{
        return view("users-list");
    }
});

Route::get('/profile/{id}', 'ProfileController@index');

Route::match(['get', 'post'], '/addComment/{userPageId}', 'CommentController@addComment');

Route::get('/deleteAllComments', 'CommentController@deleteAllComments');

Route::get('/deleteComment/{idComment}/{idPageRefrash}', 'CommentController@deleteComment');

Route::get('/loadMoreComments/{lastCommentNum}/{idUserPage}', 'CommentController@loadMoreComments');

Route::match(['get', 'post'], '/requestToComment/{idComment}', 'CommentController@requestToComment');

Route::get('/myComments', 'CommentController@showAllMyComments');


Route::group(['middleware' => 'is_user_lib_access'],  function()
{
    Route::get('/books/{id}', 'BookController@index');
    Route::get('/books/read/{id}', 'BookController@readBook');
});

Route::get('/createBook', 'BookController@openBookPage');

Route::post('/createBook', 'BookController@createBook');

// Route::get('/home/{name?}', function ($name) {
//     echo $name;
//   });
