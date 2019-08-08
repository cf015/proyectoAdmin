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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        Route::post('match', 'MatchController@createMatch');
       	Route::get('match', 'MatchController@getMatch');
       	Route::put('match', 'MatchController@updateMatch');
       	Route::delete('match', 'MatchController@deleteMatch');
       	Route::get('listMatch', 'listMatchController@getListMatch');
        Route::post('team', 'TeamController@createTeam');
        Route::get('team', 'TeamController@getTeams');
        Route::put('team', 'TeamController@updateTeam');
        Route::delete('team', 'TeamController@deleteTeam');
        Route::post('state', 'StateController@createState');
        Route::get('state', 'StateController@getState');
        Route::put('state', 'StateController@updateState');
    });
});


/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
