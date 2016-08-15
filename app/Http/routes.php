<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('home');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

// Route::group(['middleware' => ['web']], function () {
Route::group(['prefix' => '/', 'middleware' => ['web']], function () {
    
    Route::group(['middleware' => 'auth'], function () {
        
        Route::get('home', function() {
        	return view('app.home');
        });

        Route::controller('profile', 'ProfileController');
        Route::controller('profileMatching', 'ProfileMatchingController');
        Route::get('me', ['uses' => 'ProfileController@me']);
        Route::post('me', ['uses' => 'ProfileController@meUpdate']);
        Route::controller('instansi', 'InstansiController');
        Route::controller('jabatan', 'JabatanController');
        Route::controller('pns', 'PNSController');
        Route::controller('skp', 'SKPController');
        Route::group(['prefix' => 'penilaian'], function() {
            Route::get('/', 'PenilaianController@semua');
            Route::get('print', 'PenilaianController@getPrint');
            Route::get('data', 'PenilaianController@data');
            Route::get('{target_kerja_id}', 'PenilaianController@getEdit');
            Route::get('skp/{skp_id}', 'SKPController@getShow');
            Route::get('skp/{skp_id}/done', 'SKPController@getDone');
            Route::controller('skp', 'PenilaianController');
        });
        Route::controller('setting', 'SettingController');
    });
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
});
