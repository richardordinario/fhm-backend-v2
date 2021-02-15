<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register','Api\Admin\AccountController@register');
Route::post('login','Api\Admin\AccountController@login');

Route::group(['prefix' => 'teacher'], function(){
    Route::post('/login', 'Api\LoginController@login');
    Route::post('/register', 'Api\Teacher\AccountController@register');
});

Route::group(['prefix' => 'teacher', 'middleware' => ['auth:teacher']], function(){
    Route::get('/logout', 'Api\Teacher\AccountController@logout');
    Route::get('/user', function (Request $request) { return $request->user(); });

    Route::resource('account', 'Api\Teacher\AccountController');
    Route::resource('subject', 'Api\Teacher\SubjectController');

    Route::get('/pending/subjects', 'Api\Teacher\SubjectController@pending');
    Route::get('/recent/subjects', 'Api\Teacher\SubjectController@recent');
    Route::get('/drafts/subjects', 'Api\Teacher\SubjectController@drafts');

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
