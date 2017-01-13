<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('signup','DemoController@signupform' );
Route::post('signme','DemoController@signme' );

Route::group(['middleware' => 'auth'],function(){
	Route::get('importExport', 'MaatwebsiteDemoController@importExport');
    Route::post('importExcel', 'MaatwebsiteDemoController@importExcel');

    Route::post('filteremailID','MaatwebsiteDemoController@filteremailID' );
    Route::get('getDomainData/{id}','MaatwebsiteDemoController@getDomainData' );
    Route::get('postSearchData', 'MaatwebsiteDemoController@searchDomain');
    Route::post('postSearchData', 'MaatwebsiteDemoController@postSearchData');
});

// GET route
Route::get('login', function() {
  return View::make('login');
});
//POST route
Route::post('login', 'AccountController@login');
Route::get('logout', array('uses' => 'AccountController@logout'));




