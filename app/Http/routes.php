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

use Illuminate\Database\Query\Builder;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test' , function(){
    $x = \App\Lead::where('registrant_country' , 'United States')->get();
    //return($x->count());
    $arr = array();
    $i = 0;
    foreach($x as $xx)
    {
        $arr[$i++] = $xx->id;
    }
    ini_set("memory_limit","7G");
    $y = \App\Domain::whereIn('user_id' , $xx)->get();
    return ($y->count());
    
    // foreach($x as $z)
    // {
    //     $y = \App\Domain::where('user_id' , $z->id);
    // }
});


Route::get('/unlock' , function(){
    $x = \App\LeadUser::all();
    $arr  = array(); //marks all lead unlocked rectified as 1

    foreach($x as $y)
    {
        if(!isset($arr[$y->leads_id]))
        {
            $cnt = count(\App\LeadUser::where('leads_id',$y->leads_id)->get());
            $l = \App\Lead::where('id',$y->leads_id)->first();
            $l->unlocked_num = $cnt ; 
            $l->save();
            $arr[$y->leads_id] = 1;
        }
    }

    $ul = \App\Lead::where('unlocked_num' , '>' , 0)->first();

    echo('total itterations made = '.sizeof($arr) .' total rows changed ='.count($ul).'<br>');
});


Route::get('/all_domain/{email}' , 'MaatwebsiteDemoController@all_domain');

Route::get('signup','DemoController@signupform' );
Route::post('signme','DemoController@signme' );

  Route::group(['middleware' => 'auth'],function(){

	Route::get('importExport', 'MaatwebsiteDemoController@importExport');
    Route::post('importExcel', 'MaatwebsiteDemoController@importExcel');

    Route::post('filteremailID','MaatwebsiteDemoController@filteremailID' );
    Route::get('getDomainData/{id}','MaatwebsiteDemoController@getDomainData' );
    Route::get('postSearchData', 'MaatwebsiteDemoController@searchDomain');
    Route::post('postSearchData', 'MaatwebsiteDemoController@postSearchData');
    Route::get('downloadExcel', 'MaatwebsiteDemoController@downloadExcel');

    Route::post('insertUserLeads','MaatwebsiteDemoController@insertUserLeads' );
    Route::get('/myleads' , 'MaatwebsiteDemoController@myleads');


});

// GET route
Route::get('login', function() {
  return View::make('login');
});
//POST route
Route::post('login', 'AccountController@login');
Route::get('logout', array('uses' => 'AccountController@logout'));
Route::resource('product', 'ProductController');

Route::get('ajax/product', 'ProductController@ajax');
Route::get('ajax/search', 'MaatwebsiteDemoController@ajax');





