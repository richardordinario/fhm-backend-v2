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
    Route::post('/login', 'Api\Teacher\AccountController@login');
    Route::post('/register', 'Api\Teacher\AccountController@register');
});

// Route::group(['prefix' => 'teacher', 'middleware' => ['auth:teacher']], function(){
//     Route::get('/logout', 'Api\Auth\TeacherController@logout');
//     Route::get('/user', function (Request $request) { return $request->user(); });

//     Route::resource('account', 'Api\Teacher\AccountController');
//     Route::resource('subject', 'Api\Teacher\SubjectController');
// });

Route::middleware('auth:teacher')->group(function () {
    Route::get('teacher-logout', 'Api\Auth\TeacherController@logout');
    Route::get('teacher-user', function (Request $request) { return $request->user(); });
    Route::resource('teacher-account', 'Api\Teacher\AccountController');
 });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
