<?php
namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use \App\User;
use DB;
use Hash;
use Auth;
use Session;
use Input;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller {

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

	

	public function plans()
	{
		return view('subscriptions.plans');
	}

	
	public function signme(Request $request)
	{

	  //dd($request->request);
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
	     
		 $id_email = DB::table('users')->select('email')->where('email',$email)->get();
		 if(count($id_email) ==0)
		 {

		 	$u = new User();
		 	$u->name = $first_name." ".$last_name;
		 	$u->email = $email;
		 	$u->password = Hash::make($password);
		 	$u->remember_token = $remember_token;
		 	$u->user_type = 1;
		 	
		 	
			 if($u->save()) 
			 	return \Response::json(array("msg"=>"success" , "user_id"=>$u->id));
			 else 
				return \Response::json(array("msg"=>"error2" , "user_id"=>null));
	     }   
	     return \Response::json(array("msg"=>"error3" , "user_id"=>null));
		 
	 }
	   
	}
	

	public function login() {
    // Getting all post data
    $data = Input::all();
	  
    // Applying validation rules.
    $rules = array(
		'email' => 'required|email',
		'password' => 'required|min:6',
	     );
    $validator = Validator::make($data, $rules);
    if ($validator->fails()){
    return "error2";
     // return Redirect::to('/login')->withInput(Input::except('password'))->withErrors($validator);
    }
    else {
      $userdata = array(
		    'email' => Input::get('email'),
		    'password' => Input::get('password')
		  );
      // doing login.
      if (Auth::validate($userdata)) {
        if (Auth::attempt($userdata)) {
          return "success";
        }
      } 
      else {
        return "error1";
         // Session::flash('error', 'Something went wrong'); 
       
      }
    }
  }
	  public function logout() {
	  Auth::logout(); // logout user
	  return Redirect::to('/'); //redirect back to login
	}
	

}