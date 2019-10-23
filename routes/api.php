<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function ()
{
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::get('users', 'AuthController@index');
    
    // API resource creates index, store, show, update, destroy and not include create and edit.
    // one can as well add only needed methods ['only' => ['index', 'show']];
    Route::apiResource('books', 'BookController');
    Route::post('books/{book}/ratings', 'RatingController@store');
});

   