<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Stripe,Plan;
use Lava;
use \App\User;

class StripeController extends Controller
{
    public function initial_subscription(Request $request)
    {
    	if($this->doPayment($request->stripe_token , $request->plan_id , $request->email));
    	{
    		$user_id;
    		if($request->user_id == null)
    			$user_id = \Auth::user()->id;
    		else
    			$user_id = $request->user_id;
    		$user = User::where('id',$user_id)->first();
    		$user->membership_status = $request->membership_status;
    		$user->save();
    	}
    }
    private function doPayment($stripeToken , $plan_id , $customer_email)
    {

	    $secret_key = 	env('STRIPE_SECRET');
	    $stripe = Stripe::make($secret_key);
	    $customer = $stripe->customers()->create([
	      "source" => $stripeToken, // obtained from Stripe.js
	      "plan" => $plan_id,
	      "email" => $customer_email,
	    ]);

	    if($customer['subscriptions']['data'][0]['status']=="trialing" || $customer['subscriptions']['data'][0]['status']=="active")
	    	return true;

	    return false;
    }
}
