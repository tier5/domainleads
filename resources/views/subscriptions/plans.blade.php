<!DOCTYPE html>
<html>
<head>
	<title>domainleads | Subscription</title>


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



    <div class="modal fade loginsignup" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
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




    <div class="col-md-8 modal fade" id="payment_info_module" role="dialog" tabindex="-1" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button id="close_payment_info_module" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×</button>
                    <h4 class="modal-title" id="myModalLabel">
                        Make Payment</h4>
                        <div id="errormsg"></div>
                </div>
                <div class="modal-body">
                    <label>**Payment confrontation**</label>
                    <p>LOREUM IPSUM LOREUM IPSUMLOREUM IPSUMLOREUM IPSUMLOREUM IPSUMLOREUM IPSUMLOREUM IPSUMLOREUM IPSUMLOREUM IPSUMLOREUM IPSUMLOREUM IPSUMLOREUM IPSUMLOREUM IPSUMLOREUM IPSUMLOREUM IPSUM</p>
                    <button id="pay_later" class="pull-right">Later</button>
                    <button id="take_to_payment" class="pull-left">Pay Now</button>
                </div>
            </div>
        </div>
    </div>





<div class="modal fade loginsignup" id="myModal_for_reg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" id="close_reg_modal" class="close" data-dismiss="modal" aria-hidden="true">
                    ×</button>
                <h4 class="modal-title" id="myLargeModalLabel">
                    Register</h4>
                    <div id="errormsg_reg"></div>
            </div>
            <div class="modal-body">
                                
                <div class="signup-form">
 
                   
                {!! Form::open(array('url'=>'')) !!}
                <div class="form-group">
                {!! Form ::text('first_name','',array('class'=>'formtext form-control','id'=>"first_name","placeholder"=>'First Name')) !!}
                </div>
                <div class="form-group">
                {!! Form ::text('last_name','',array('class'=>'formtext form-control','id'=>"last_name","placeholder"=>'Last Name')) !!}
                </div>
                <div class="form-group">
                {!! Form ::text('email','',array('class'=>'formtext form-control','id'=>"email_reg","placeholder"=>'Email Address')) !!}
                </div>
                <div class="form-group">
                {!! Form ::password('password',array('class'=>'formtext form-control','id'=>"password_reg","placeholder"=>'Password')) !!}
                </div>
                <div class="form-group">
                {!! Form ::password('c_password',array('class'=>'formtext form-control','id'=>"c_password_reg","placeholder"=>'Confirm Pasword')) !!}
                </div>
                <div class="form-group">
                {!! Form ::button('button',array('class'=>'send-btn','id' => 'submitbtn_reg')) !!}
                </div>
                {!! Form::close() !!}
                </div> 

               
            </div>
        </div>
    </div>
</div>




<div id="price" class="section secondary-section">
        <div class="container">
            <div class="title">
                <h1>Montlhy Pricing</h1>
                <p>You won't find a more competitive price for the same features.</p>
            </div>
            <div class="price-table row-fluid">
                <div class="span4 price-column">
                    <h3>Basic</h3>
                    <ul class="list">
                        <li class="price">$9.99</li>
                        <input type="hidden" id="basic_amount" name="amount" value="9.99">
                        <input type="hidden" id="basic_plan" name="plan" value="basic_plan">
                        <li><strong>50</strong> Monthly Leads</li>
                        <li><strong>$0.99</strong> Each additional Lead</li>
                        <li><strong>Basic</strong> Filters</li>
                        <li><strong>NO</strong> CRM</li>
                    </ul>
                    @if(\Auth::check())
                        @if(\Auth::user()->membership_status >= 1)
                        <button class="button button-ps">SUBSCRIBED</button>
                        @else
                        <button id="basic_" class="button button-ps" data-val="basic" data-login="1">BUY</button>
                        @endif
                    @else
                        <button id="basic" class="button button-ps" data-val="basic" data-toggle="modal" data-target="#myModal_for_reg">BUY</button>
                    @endif


                    
                    
                    <!-- <a href="#" id="basic" class="button button-ps">BUY</a> -->
                </div>
                <div class="span4 price-column">
                    <h3>Pro</h3>
                    <ul class="list">
                        <li class="price">$49.99</li>
                        <input type="hidden" id="premium_amount" name="amount" value="49.99">
                        <input type="hidden" id="premium_plan" name="plan" value="premium_plan">
                        <li><strong>500</strong> Monly Leads</li>
                        <li><strong>$0.50</strong> Each additional Lead</li>
                        <li><strong>Full</strong> Filters</li>
                        <li><strong>Basic</strong> CRM</li>
                    </ul>
                    @if(\Auth::check())    
                        @if(\Auth::user()->membership_status >= 2)
                            <button class="button button-ps">SUBSCRIBED</button>
                        @else
                            <button id="premium_" class="button button-ps" data-login="1" data-val="premium">BUY</button>
                        @endif
                    @else
                        <button id="premium" class="button button-ps" data-val="premium" data-toggle="modal" data-target="#myModal_for_reg">BUY</button>
                    @endif
                    
                </div>
                <div class="span4 price-column">
                    <h3>Premium</h3>
                    <ul class="list">
                        <li class="price">$99.99</li>
                        <input type="hidden" id="advanced_amount" name="amount" value="99.99">
                        <input type="hidden" id="advanced_plan" name="plan" value="advanced_plan">
                        <li><strong>5000</strong> Monthly Leads</li>
                        <li><strong>$0.25</strong> Each additional Lead</li>
                        <li><strong>Full</strong> Filters</li>
                        <li><strong>Full</strong> CRM</li>
                    </ul>
                    @if(\Auth::check())
                        @if(\Auth::user()->membership_status >= 3)
                            <button class="button button-ps">SUBSCRIBED</button>
                        @else
                            <button id="advanced_" data-login="1" class="button button-ps" data-val="advanced">BUY</button>
                        @endif
                    @else
                        <button href="#" id="advanced" class="button button-ps" data-val="advanced" data-toggle="modal" data-target="#myModal_for_reg">BUY</button>
                    @endif
                    
                </div>
            </div>
            <div class="centered">
                <p class="price-text">We Offer Custom Plans. Contact Us For More Info.</p>
                <a href="#contact" class="button">Contact Us</a>
            </div>
        </div>
    </div>


</body>


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

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>

<script type="text/javascript">

    var amount;
    var plan_id;
    var email = '{{\Auth::check() ? \Auth::user()->email : null}}';
    var user_id = '{{\Auth::check() ? \Auth::user()->id : null}}' ;
    var membership_status;

    


    function open_reg_modal()
    {
        $('#myModal_for_reg').addClass('in');
        $('#myModal_for_reg').attr('area-hidden' , false);
        $('#myModal_for_reg').css({"display":"block"});
    } 
    $('#close_reg_modal').click(function(e){
        $('#myModal_for_reg').removeClass('in');
        $('#myModal_for_reg').attr('area-hidden' , true);
        $('#myModal_for_reg').css({"display":"none"});
    });
    $('#close_payment_info_module').click(function(){
        $('#payment_info_module').removeClass('in');
        $('#payment_info_module').attr('area-hidden' , true);
        $('#payment_info_module').css({"display":"none"});
    });

    function show_payment_info_module()
    {
        $('#payment_info_module').addClass('in');
        $('#payment_info_module').attr('area-hidden' , false);
        $('#payment_info_module').css({"display":"block"});
    }

	$( document ).ready(function() {
		Stripe.setPublishableKey("{{env('STRIPE_KEY')}}");



        $('#take_to_payment').click(function(){
            open_handler();
        });
        $('#pay_later').click(function(){
            $('#close_payment_info_module').click();
        });

 		var handler1 = StripeCheckout.configure({
                key: "{{env('STRIPE_KEY')}}",
                image: '',
                locale: 'auto',
                token: function(token) {
                  $.ajax({
                    url: "/stripe_initial_subscription",
                    data: { email:token.email ,
                            stripe_token:token.id,
                            amount:amount,
                            plan_id:plan_id,
                            _token:'{!! csrf_token() !!}',
                            membership_status:membership_status,
                            user_id:user_id},
                    type :"post",
                    success: function(data)
                    {
                    	console.log(data);
                    	window.location.replace("{{url('/')}}/plans");
                    	
                    },
                    error: function(data)
                    {
                        console.log(data);
                    }
                  });
               }
        });  

	$(window).on('popstate', function() { // close stripe handler when window closed
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

        $('#popupid_for_reg').click(function(){ amount = 0.00; plan_id = ''; membership_status=0; });

        $('#basic').click(function(e){ 
            amount = 9.99; 
            plan_id = 'basic_plan'; 
            membership_status=1;
        });

        $('#basic_').click(function(e){ 
            amount = 9.99; 
            plan_id = 'basic_plan'; 
            membership_status=1;
            open_handler();
        });

         
        $('#premium').click(function(e){ 
            amount = 49.99; 
            plan_id = 'premium_plan'; 
            membership_status=2;
        });
        $('#premium_').click(function(e){ 
            amount = 49.99; 
            plan_id = 'premium_plan'; 
            membership_status=2;
            open_handler();
        });

          
        $('#advanced').click(function(e){ 
            amount = 99.99; 
            plan_id = 'advanced_plan'; 
            membership_status=3;
        });
        $('#advanced_').click(function(e){ 
            amount = 99.99; 
            plan_id = 'advanced_plan'; 
            membership_status=3;
            open_handler();
        });

        function open_handler()
        {
            console.log(plan_id , amount , email , membership_status);
            handler1.open({
                name: 'domainleads.io',
                description: 'Subscription form',
                amount: amount * 100,
                email : email,
                currency: 'usd'
              });
        }


        $("#submitbtn_reg").click(function(e){
            

            var first_name=$("#first_name").val();
            var last_name=$("#last_name").val();
            var email_reg=$("#email_reg").val();
            var password_reg=$("#password_reg").val();
            var c_password_reg=$("#c_password_reg").val();

            email = email_reg;

            console.log(plan_id , amount , email);
           	$.ajax({
               type:'POST',
               url:'signme',
               data:'first_name='+first_name+'&last_name='+last_name+'&email='+email_reg+'&password='+password_reg+'&c_password='+c_password_reg,
               success:function(data){
                console.log(data);
                if(data.msg=='success')
                {
                    user_id = data.user_id;
                    //$('#submitbtn_reg').attr('disabled', true);
                    if(plan_id != '')
                    {
                        $("#errormsg_reg").html('Account created successfully'); 
                        $("#close_reg_modal").click().delay(300);
                        show_payment_info_module();   
                    }
                    else
                    {
                        $("#errormsg_reg").html('Successfully Signed');
                        window.location.href = "{{url('/')}}/plans";
                    }           
                }
                if(data.msg=='error1'){
                   $("#errormsg_reg").html('Data not correct');
                }
                if(data.msg=='error2'){
                   $("#errormsg_reg").html('Please signup again');
                } 
                if(data.msg=='error3'){
                   $("#errormsg_reg").html('Email exists');
                } 
                 
               }
            });

            e.preventDefault();
        }); 


        // $("#submitbtn_reg").blur(function(e){
        //     $('#submitbtn_reg').attr('disabled', false);
        // }); 

});
   
</script>
</html>