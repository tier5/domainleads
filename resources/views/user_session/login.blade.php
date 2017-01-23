<!DOCTYPE html>
<html>
<head>
	<title>domainleads | login</title>

	<meta charset=utf-8>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>domainleads | Subscription</title>
        <!-- Load Roboto font -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <!-- Load css styles -->


        <link rel="stylesheet" type="text/css" href="{{url('/')}}/theme/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="{{url('/')}}/theme/css/bootstrap-responsive.css">
        <link rel="stylesheet" type="text/css" href="{{url('/')}}/theme/css/style.css">
        <link rel="stylesheet" type="text/css" href="{{url('/')}}/theme/css/pluton.css">


        <link rel="stylesheet" type="text/css" href="{{url('/')}}/theme/css/jquery.cslider.css">
        <link rel="stylesheet" type="text/css" href="{{url('/')}}/theme/css/jquery.bxslider.css">
        <link rel="stylesheet" type="text/css" href="{{url('/')}}/theme/css/animate.css">

		    
        <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="css/pluton-ie7.css" />
        <![endif]-->
		
    
      
        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/apple-touch-icon-72.png">
        <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57.png">
        <link rel="shortcut icon" href="images/ico/favicon.ico">
</head>
<body>


	<div>


		<div class="navbar">
	        <div class="navbar-inner">
	            <div class="container">
	                <a href="#" class="brand">
					
	                    <!--<img src="images/logo.png" width="120" height="40" alt="Logo" />-->

	                    <img src="{{url('/')}}/theme/images/logo.png">
	                    <!-- This is website logo -->
	                </a>
	                <!-- Navigation button, visible on small resolution -->
	                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	                    <i class="icon-menu"></i>
	                </button>
	                <!-- Main navigation -->
	                <div class="nav-collapse collapse pull-right">
	                    <ul class="nav" id="top-navigation">
	                        <li><a href="{{url('/')}}">Home</a></li>
	                        <li><a href="#service">Services</a></li>
	                        <li><a href="#portfolio">How it works</a></li>
	                        <li><a href="#about">About</a></li>
	                        <li><a href="#clients">Clients</a></li>
	                        <li class="active"><a href="{{url('/')}}/plans">Plans</a></li>
	                        <li><a href="#price">Pricing</a></li>
	                         @if (Auth::check())
	                         <li> <a href="{{ URL::to('postSearchData') }}">Search Domain</a></li>
	                         <li> <a href="{{ URL::to('logout') }}">Logout</a></li>
	                          @else 
	                        <li> <button class="" id="popupid" data-toggle="modal" data-target="#myModal">SignIn</button></li>
	                        <li><button class="" id="popupid_for_reg" data-toggle="modal" data-target="#myModal_for_reg">SignUp</button></li>
	                        @endif
	                    </ul>
	                   
	                </div>
	                <!-- End main navigation -->
	            </div>
	        </div>
	    </div>



	    
		


		<div class="col-md-6">
		    
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
		                    ×</button>
		                <h4 class="modal-title" id="myModalLabel">
		                    Login</h4>
		                    <div id="errormsg"></div>
		            </div>
		            <div class="modal-body">
		                {{ Form::open(array('url' => '')) }}
		                <div class="form-group">
		                {{ Form::text('email','',array('id'=>'email_id_login','class'=>'form-control','placeholder' => 'Please Enter your Email')) }}
		                <p class="errors">{{$errors->first('email')}}</p>
		                </div>
		                <div class="form-group">
		                {{ Form::password('password',array('class'=>'form-control', 'placeholder' => 'Please Enter your Password','id'=>'password')) }}
		                <p class="errors">{{$errors->first('password')}}</p>
		                </div>
		                <div class="form-group">
		                {{ Form::button('Submit', array('class'=>'send-btn','id' => 'submitbtn')) }}
		                {{ Form::close() }}
		                </div>
		            </div>
		        </div>
		    </div>
		</div>



	</div>

	
	{!! Html::script('theme/js/jquery.js') !!}
        {!! Html::script('theme/js/jquery.mixitup.js') !!}
        {!! Html::script('theme/js/bootstrap.js') !!}
        {!! Html::script('theme/js/modernizr.custom.js') !!}
        {!! Html::script('theme/js/jquery.bxslider.js') !!}
        {!! Html::script('theme/js/jquery.cslider.js') !!}
        {!! Html::script('theme/js/jquery.placeholder.js') !!}
        {!! Html::script('theme/js/jquery.inview.js') !!}
        
          {!! Html::script('theme/js/app.js') !!}
        {!! Html::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyB3PpQ1EOAybx-Bkx1X52noOoPR_Fh_d1w &callback=initializeMap') !!}


    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="https://checkout.stripe.com/checkout.js"></script>

        <script type="text/javascript">
	$( document ).ready(function() {

		Stripe.setPublishableKey('pk_test_NeErELVu7Qbv59BWm0c7HQT1');

        // $("popupid").click(function(){
        //     $('#myModal').modal('show');
        // }); 
        // $("popupid_for_reg").click(function(){
        //     $('#myModal_for_reg').modal('show');
        // }); 
       


     		var handler1 = StripeCheckout.configure({
                    key: '{{ pk_test_NeErELVu7Qbv59BWm0c7HQT1 }}',
                    image: '',
                    locale: 'auto',
                    token: function(token) {
                      //alert(token.id);
                      //alert(token.email);
                      var amount      = 9.99;
                      var plan        = 'tr5Basic';
                      var currency    = 'usd';
                      var time        = $('#time').text();
                      var admin_id    = 1;
                      
                      $.ajax({
                        url: "{{url('/')}}/login",
                        data: {email:token.email,admin_id:admin_id,stripe_token:token.id,amount:amount,inv:inv,currency:currency,time:time,plan:plan,_token:'{!! csrf_token() !!}'},
                        type :"post",
                        success: function(data)
                        {
                          $('#sub_tick').show();
                          $('#sub_').hide();
                          $('#subscribed').show();
                          // $('#sub_').removeClass('btn-primary');
                          // $('#sub_').addClass('btn-success');
                          // $('#sub_').text('subscribed');
                          sub_status = 1;
                          $('#loader').hide();

                            var urlnew="<?php echo url('/');?>/client/invoice/"+inv;
                            $(location).attr('href',urlnew);
                          
                        }
                      });
                   }
            });  

        

     	$(window).on('popstate', function() {
                handler1.close();
              });
        
        $("#submitbtn").click(function(e){
            var email=$("#email_id_login").val();
            var password=$("#password").val();
           $.ajax({
               type:'POST',
               url:'login',
               data:'email='+email+'&password='+password,
               success:function(data){
               // console.log(data);
                if(data=='success'){
                  window.location.href = 'importExport';
                }
                if(data=='error1'){
                   $("#errormsg").html('User is not registered');
                }
                if(data=='error2'){
                   $("#errormsg").html('Invalid login credentials');
                } 
                 
               }
            });
        });  

        $('#random').click(function(e){
        	alert(1);
        	handler1.open({
                name: '{{ $Invoice->admin_details == null ? "INVOICINGYOU" : $Invoice->admin_details->name }}',
                description: 'Plan: '+plan+' [duration: '+ time +']',
                amount: amount,
                currency: currency
              });
        	e.preventDefault();
        });
        $("#submitbtn_reg").click(function(e){



        	


            var first_name=$("#first_name").val();
            var last_name=$("#last_name").val();
            var email_reg=$("#email_reg").val();
            var password_reg=$("#password_reg").val();
            var c_password_reg=$("#c_password_reg").val();


           	$.ajax({
               type:'POST',
               url:'signme',
               data:'first_name='+first_name+'&last_name='+last_name+'&email='+email_reg+'&password='+password_reg+'&c_password='+c_password_reg,
               success:function(data){
                //console.log(data);
                if(data=='success'){

                	open_handler();
                   $("#errormsg_reg").html('Successfully Signed');
                }
                if(data=='error1'){
                   $("#errormsg_reg").html('Data not correct');
                }
                if(data=='error2'){
                   $("#errormsg_reg").html('Please signup again');
                } 
                if(data=='error3'){
                   $("#errormsg_reg").html('Email exists');
                } 
                 
               }
            });
        });  

});
   
</script>

</body>
</html>