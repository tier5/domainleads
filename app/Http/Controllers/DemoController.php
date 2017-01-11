<?php
namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use DB;
use Hash;
use Auth;
class DemoController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
		return View::make('home.index');
	}
	

	public function getLogin()
	{
		return View::make('home.login');
	}


    public function demofunction(){
	return view('demoview');
	}
	
	 public function aboutfunction(){
	return view('about');
	}
	
	public function signupform(){
	return view('signup_form');
	}
	public function login_form(){
	return view('mylogin');
	}
	public function checklogin(Request $request){
	
	//print_r($request->all());dd();
	$user=array("email"=>$request->email,"password"=>$request->password);
		if(Auth::attempt($user)){
		// return "hi";
		  return redirect()->intended('user_profile');
		}else {
		   return redirect('mylogin')->with('error','provide valid data');
		}
	   //print_r($request->all());
	}
	public function getprofile() {
	  return view('user_profile');
	}
	
	public function mylogout() {
	
	Auth::logout();
	return redirect()->intended('mylogin');
	}
	public function signme(Request $request){
	  
	  //print_r($request->all()); dd();
	 $first_name=$request->first_name;
	  $last_name=$request->last_name;
	   $email=$request->email;
	   $password=$request->password;
	    $remember_token=$request->_token;
		$date=date('Y-m-d H:i:s');
	 
	 $validator=Validator::make(
	  array(
	  'first_name'=>$request->first_name,
	   'last_name'=>$request->last_name,
	    'email'=>$request->email,
		 'password'=>$request->password,
		  'c_password'=>$request->c_password
	  ),
	  array(
	  'first_name'=>'required',
	   'last_name'=>'required',
	    'email'=>'required|email',
		 'password'=>'required',
		  'c_password'=>'required | same:password'
	  )
	 );
	 
	 if($validator->fails()) {
	 //return redirect('signup')->withErrors($validator)->withInput();
	 	return "error1";
	 } else {
	     
		 $data=array(
			"name"=>$first_name." ".$last_name,
			"email"=>$email,
			"password"=>Hash::make($password),
			"remember_token"=>$remember_token,
			"created_at"=>$date,
			"updated_at"=>$date
		 
		 );
		 $id_email=DB::table('users')->select('email')->where('email',$email)->get();
		 if(count($id_email) ==0 ){
		 
		 
			 if(DB::table('users')->insert($data)) {
			   //return redirect('/')->with("success","Successfully Signed");
			 	return "success";
			 } else {
				//return redirect('/')->with("error","Unsuccessfully Signed");
				return "error2";
			 }
	     } else {
		   // return redirect('/')->with("error","Email exists");
	     	return "error3";
		 }
	 }
	   
	}
	

	public function logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}
	

}