<h1>Signup Form</h1>
<div class="signup-form">

 @if( count($errors) > 0)
   <div class="alert alert-danger">
   <strong>woops!</strong>
     <ul>
	   @foreach($errors->all() as $error) 
	     <li>{{ $error }} </li>
		@endforeach 
	 </ul>
   </div>
 @endif
 
   @if(Session::has('success'))
     {{ Session::get('success')}}
   @endif
   @if(Session::has('error'))
      {{ Session::get('error')}}
   @endif
   
{!! Form::open(array('url'=>'signme')) !!}
{!! Form ::text('first_name','',array('class'=>'formtext','id'=>"first_name","placeholder"=>'First Name')) !!}
{!! Form ::text('last_name','',array('class'=>'formtext','id'=>"last_name","placeholder"=>'Last Name')) !!}
{!! Form ::text('email','',array('class'=>'formtext','id'=>"email","placeholder"=>'Email Address')) !!}
{!! Form ::password('password','',array('class'=>'formtext','id'=>"password","placeholder"=>'Password')) !!}
{!! Form ::password('c_password','',array('class'=>'formtext','id'=>"email","placeholder"=>'Confirm Pasword')) !!}
{!! Form ::submit('submit') !!}
{!! Form::close() !!}
</div>