<?php
namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\Validator;
use Input;
use Illuminate\Support\Facades\Redirect;
use Session;
class AccountController extends Controller {
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