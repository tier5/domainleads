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
    return view('home');
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



    Route::get('/plans' , 'HomeController@plans');



    Route::get('/all_domain/{email}' , 'DomainLeadsController@all_domain');

    Route::post('/stripe_initial_subscription' , 'StripeController@initial_subscription');

 
    Route::post('signme','HomeController@signme' );

    Route::group(['middleware' => 'auth'],function(){

    	Route::get('importExport', 'DomainLeadsController@importExport');
        Route::post('importExcel', 'DomainLeadsController@importExcel');

        Route::post('filteremailID','DomainLeadsController@filteremailID' );
        Route::get('getDomainData/{id}','DomainLeadsController@getDomainData' );
        Route::get('postSearchData', 'DomainLeadsController@searchDomain');
        Route::post('postSearchData', 'DomainLeadsController@postSearchData');
        Route::get('downloadExcel', 'DomainLeadsController@downloadExcel');

        Route::post('insertUserLeads','DomainLeadsController@insertUserLeads' );
        Route::get('/myleads' , 'DomainLeadsController@myleads');


   });


    Route::post('login', 'HomeController@login');
    Route::get('logout', array('uses' => 'HomeController@logout'));


    Route::get('ajax/search', 'DomainLeadsController@ajax');






