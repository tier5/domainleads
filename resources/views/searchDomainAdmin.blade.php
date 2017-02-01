<html lang="en">
@include('layouts.header')
<head>

	<title>Search Domain</title>
	 
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    
        {!! Html::style('resources/assets/css/bootstrap.css') !!}
		{!! Html::style('theme/css/bootstrap-responsive.css') !!}
		{!! Html::script('resources/assets/js/jquery-1.12.0.js') !!}
		{!! Html::script('theme/js/bootstrap.js') !!}
		
       
</head>

<body>

		<div class="container-fluid">

			<div class="navbar-header">

				<a class="navbar-brand" href="#">Search Domain</a>  

                @if(Session::has('msg'))
                {{ Session::get('msg')}}
                @endif
			</div>

		</div>

	

	<div class="container">

		<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('postSearchData') }}" class="form-horizontal" method="post" enctype="multipart/form-data">

			Domain Name<input type="text" name="domain_name" id="domain_name" value="{{ Input::get('domain_name') }}" />
			Registrant Country<input type="text" name="registrant_country" id="registrant_country" value="{{ Input::get('registrant_country') }}" />

			Registered Date<input type="text" name="create_date" id="datepicker" class="" value="{{ Input::get('create_date') }}" />

			<br>
			State<input type="text" name="registrant_state" id="registrant_state" value="{{ Input::get('registrant_state') }}"> 

			 <br/>
            .com<input type="checkbox" name="tdl_com" id="tdl_com" value='1' <?php if(Input::get('tdl_com')==1) { echo "checked";} ?>>
            .net<input type="checkbox" name="tdl_net" id="tdl_net" value='1' <?php if(Input::get('tdl_net')==1) { echo "checked";} ?>>
            .org<input type="checkbox" name="tdl_org" id="tdl_org"  value='1' <?php if(Input::get('tdl_org')==1) { echo "checked";} ?>>
            .io<input type="checkbox" name="tdl_io" id="tdl_io" value='1' <?php if(Input::get('tdl_io')==1) { echo "checked";} ?>>
            Cell Number<input type="checkbox" name="cell_number" id="cell_number" value='1' <?php if(Input::get('cell_number')==1) { echo "checked";} ?>>
            Landline Number<input type="checkbox" name="landline" id="landline" value='1' <?php if(Input::get('landline')==1) { echo "checked";} ?>>

			<button class="btn btn-primary">Search</button>

		</form>
		<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('downloadExcel') }}" class="form-horizontal" method="get" enctype="multipart/form-data">
        <input type="hidden" name="domain_name_downloadExcel"  value="{{ Input::get('domain_name') }}" />
		<input type="hidden" name="registrant_country_downloadExcel" id="registrant_country" value="{{ Input::get('registrant_country') }}" />

		<input type="hidden" name="create_date_downloadExcel"  class="" value="{{ Input::get('create_date') }}" />

		<input type="hidden" name="registrant_state_downloadExcel"  class="" value="{{ Input::get('registrant_state') }}" />
		
        <input type="hidden" name="tdl_com_downloadExcel" value="{{ Input::get('tdl_com') }}" >
        <input type="hidden" name="tdl_net_downloadExcel" value="{{ Input::get('tdl_net') }}" >
        <input type="hidden" name="tdl_org_downloadExcel" value="{{ Input::get('tdl_org') }}">
        <input type="hidden" name="tdl_io_downloadExcel" value="{{ Input::get('tdl_io') }}">
        <input type="hidden" name="cell_number_downloadExcel" value="{{ Input::get('cell_number') }}" >
        <input type="hidden" name="landline_downloadExcel" value="{{ Input::get('landline') }}">

        <input type="hidden" name="domains_for_export" id="domains_for_export_id" value="">
         <input type="hidden" name="domains_for_export_allChecked" id="domains_for_export_id_allChecked" value="0">
		 <button class="btn btn-primary" id="exportID">Export</button>

		</form>
	<div class="container">
	
    <h2>Search Result</h2>
    <input type="hidden" id="filteredemail"  value=""> 
    <button class="btn btn-success"  id=""   data-toggle="modal" data-target="#myModal_allemail">Send Email</button>
   
    <div id="filtereddataid" class="content"> 

		  <table class="table table-hover table-bordered domainDAta">
		    <thead>
		      <tr>
		        <th><input type="checkbox"  value="1" class="downloadcsv_all" id=""></th>
		        <th>Domain Name</th>
		        <th>Registrant Name</th>
		        <th>Registrant Email</th>
		        <th>Registrant Phone</th>
		        <th>Registered Date</th>
		        <th>Registrant Company</th>
		        <th>Actions</th>
		        <!--
		        <th>Registrant Address</th>
		        <th>Registrant City</th>
		        <th>Registrant State</th>
		        <th>Registrant Zip</th>
		        <th>Registrant Country</th>
		        
		        <th>Expiry Date</th>
		        <th>Domain Registrar ID</th>
		        <th>Domain Registrar Name</th>
		        <th>Domain Registrar Whois</th>
		        <th>Domain Registrar Url</th>
		        -->
		      </tr>
		    </thead>
		    
		    <tbody>
		     

		      @if(count($requiredData))  
				@foreach($requiredData as $key=>$value)
		         
				    <?php 
				    if (Auth::user()->user_type=='1'){
					     $domainName=$value->domain_name;
					     $domainname=strstr($domainName, '.', true);
					     $ext=substr(strrchr($domainName, "."), 1);
					     $var='';
					    for ($x = 0; $x < strlen($domainname); $x++){
					    	if($x==0){
					        $var=$domainname[$x];
					    	}
					        elseif($x==(strlen($domainname)-1)){
					        $var=$var.$domainname[$x];	
					        }
					    	else {		        
					        $var=$var.'*';
					        }
					       
					    }
					    $domainName_new= $var.'.'.$ext;
				    }else {
				    $domainName_new	=$value->domain_name;
				    }

						if (in_array($value->leads_id, $leadusersData))
						{
						  $style_unpaid='style="display: none;"';
						  $style_paid='style="display: block;"';
                          $checked='checked="checked"';
                          $disabled='disabled="true"';
						}
						else
						{
						  $style_unpaid='style="display: block;"';
						  $style_paid='style="display: none;"';
						  $checked='';
						  $disabled='';
						}
                        //$phonenumber='';
						if($value->http_code=='200'){

                              
                                  if($value->number_type=='Landline'){
                                    $phonenumber="<img src='theme/images/landline.png' width='25'>";
                                   
                                  }else {
                                    $phonenumber="<img src='theme/images/cellnumber.png' width='40'>";
                                   
                                  }
                           $class='class="tooltip2"';
                            $option='';       
                        }          
                        else if($value->http_code=='404'){
                            $phonenumber="<img src='theme/images/nophone.png' width='56'>";
                             $class='';
                             $option='style="display:none"';
                        }     
						else {
                           $phonenumber=$value->phone_number;
                            $class='';
                             $option='style="display:none"';
						}
				    ?>
			      <tr>
			        <td>
                      <div><input type="checkbox" name="downloadcsv" class="eachrow_download" value="1" id="{{$value->domain_id}}"></div>
			        </td>
			        <td >
				        
	                     <div><a href="http://{{ $value->domain_name }}" target="_blank">{{ $value->domain_name}}</a></div>
	                     <br>
	                     <small>Unlocked : {{$value->unlocked_num == null ? 0 : $value->unlocked_num}} times</small>
	                     <br>
	                     <small id="domain_count"> Total Domains: <a href="/all_domain/{{base64_encode($value->registrant_email)}}">{{$count_domain[$value->registrant_email]}}</a></small>
			        </td>

			        
			        <td>{{ $value->registrant_name}}</td>
			        <td>
			        	{{ $value->registrant_email}}
			        	<br>
			        	<!-- <a href="/all_domain/{{base64_encode($value->registrant_email)}}">Other domains</a> -->
			        </td>

			        <td>			            
				        <div><a href="#" <?php echo $class;?>><?php echo $phonenumber;?><span <?php echo $option ;?> > <img class="callout" src="theme/images/Callout.gif" />
	                    <table><tr><td>Phone No:<?php echo $value->phone_number;?></td><td>State: <?php echo $value->state;?></td><td>City :<?php echo $value->major_city;?></td></tr></table> </span></a></div>
                    </td>

			        <td>{{ $value->create_date}}</td>
			        <td>{{ $value->registrant_company}}</td>
			        <td><a href="getDomainData/{{base64_encode($value->registrant_email)}}" target="_blank"><button class="btn btn-success">View</button></a><button class="btn btn-success" id="popupid" onclick="sendindividualemailfunction('<?php echo $value->registrant_email ?>','<?php echo $value->domain_name ?>','<?php echo $value->create_date ?>','<?php echo $value->registrant_company ?>','<?php echo $value->phone_number ?>')"   data-toggle="modal" data-target="#myModal">Send Email</button></td>
			       
			        <!--
			        <td>{{ $value->registrant_address}}</td>
			        <td>{{ $value->registrant_city}}</td>
			        <td>{{ $value->registrant_state}}</td>
			        <td>{{ $value->registrant_zip}}</td>
			        <td>{{ $value->registrant_country}}</td>
			      
			        
			       
			        <td>{{ $value->expiry_date}}</td>
			        <td>{{ $value->domain_registrar_id}}</td>
			        <td>{{ $value->domain_registrar_name}}</td>
			        <td>{{ $value->domain_registrar_whois}}</td>
			        <td>{{ $value->domain_registrar_url}}</td>
					-->
			      </tr>
		        @endforeach
		   
			@endif 
			
		    </tbody>
		     
		  </table>
		   @if(count($requiredData))
		    {{$requiredData->links()}}  
	       @endif 
     </div>
   
</div> 
		
</div>
<div class="modal fade" id="myModal_allemail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×</button>
                <h4 class="modal-title" id="myModalLabel">
                    Send Email</h4>
                    <div id="msg_for_emailpart_all"></div>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => '')) }}
                
                <div class="form-group">
                Use mail template <input type="checkbox" id="use_mail_template_for_all" value="1">
                </div>
                <div class="form-group">
                <textarea name="content_for_sendingemail_all" id="content_for_sendingemail_all" rows="5" cols="30"></textarea>
                <input type="hidden" name="use_template_all" id="use_template_all" value="0">
                </div>
                
                <div class="form-group">
                {{ Form::button('Submit', array('class'=>'send-btn','id' => 'submitbtn_for_sendingemail_all')) }}
                {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×</button>
                <h4 class="modal-title" id="myModalLabel">
                    Send Email</h4>
                    <div id="msg_for_emailpart"></div>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => '')) }}
                <div class="form-group">
                <input type="text" name="emailID_for_sendingemail" id="emailID_for_sendingemail" readonly="readonly" value="">
                </div>
                <div class="form-group">
                Use mail template <input type="checkbox" id="use_mail_template_for_individual" value="1">
                </div>
                <div class="form-group">
                <textarea name="content_for_sendingemail" id="content_for_sendingemail" rows="5" cols="30"></textarea>
                <input type="hidden" name="use_template" id="use_template" value="0">
                </div>
                <div class="form-group">
                <span id="domain_name_for_sendingemail"></span>&nbsp;
                <span id="create_date_for_sendingemail"></span>&nbsp;
                <span id="registrant_company_for_sendingemail"></span>&nbsp;
                <span id="phone_number_for_sendingemail"></span>&nbsp;
                </div>
                <div class="form-group">
                {{ Form::button('Submit', array('class'=>'send-btn','id' => 'submitbtn_for_sendingemail')) }}
                {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
</body>

 <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script>
    
    $( document ).ready(function() {
         $("#use_mail_template_for_individual").click(function(){
            if($("#use_mail_template_for_individual").is(':checked')) {
              $("#content_for_sendingemail").val('Hey [name ],How are u doing today?here are few of our [website]');
              $("#use_template").val(1);
            }else{
            	 $("#content_for_sendingemail").val('');
            	 $("#use_template").val(0);
            }
         });

         $("#use_mail_template_for_all").click(function(){
            if($("#use_mail_template_for_all").is(':checked')) {
              $("#content_for_sendingemail_all").val('Hey [name ],How are u doing today?here are few of our [website]');
              $("#use_template_all").val(1);
            }else{
            	 $("#content_for_sendingemail_all").val('');
            	 $("#use_template_all").val(0);
            }
         });
     });       
  function sendindividualemailfunction(registrant_email,domain_name,create_date,registrant_company,phone_number){
    
  	$("#emailID_for_sendingemail").val(registrant_email);
  	$("#domain_name_for_sendingemail").text(domain_name);
  	$("#create_date_for_sendingemail").text(create_date);
  	$("#registrant_company_for_sendingemail").text(registrant_company);
  	$("#phone_number_for_sendingemail").text(phone_number);
  	$("#use_mail_template_for_individual").prop( "checked", false);
    $("#content_for_sendingemail").val('');

  }
   $("#submitbtn_for_sendingemail").click(function(){
            var emailID_for_sendingemail=$("#emailID_for_sendingemail").val();
            var content_for_sendingemail=$("#content_for_sendingemail").val();
             var use_template=$("#use_template").val();
            
           $.ajax({
               type:'POST',
               url:'sendemailindividual',
               beforeSend: function()
					{
						$('#msg_for_emailpart').html('<span align="center"><img src="theme/images/loading.gif">sending...</span>');
					},
               data:'emailID_for_sendingemail='+emailID_for_sendingemail+'&content_for_sendingemail='+content_for_sendingemail+'&use_template='+use_template,
               success:function(data){
               	if(data=='success'){
               		$("#use_mail_template_for_individual").prop( "checked", false);
                    $("#content_for_sendingemail").val('');
                    $("#msg_for_emailpart").html('Mail sent');
               	}
               
                 
               }
            });
        });
    $("#submitbtn_for_sendingemail_all").click(function(){
            var domain_name=$("#domain_name").val();
			var registrant_country=$("#registrant_country").val();
			var datepicker=$("#datepicker").val();
			var domains_for_export_id=$("#domains_for_export_id").val();
			var domains_for_export_id_allChecked=$("#domains_for_export_id_allChecked").val();
			var registrant_state=$("#registrant_state").val();

			
				if($("#tdl_com").is(':checked')){
				 var tdl_com='1';	
				}else {
				 var tdl_com='0';	
				}
				if($("#tdl_net").is(':checked')){
				 var tdl_net='1';	
				}else {
				 var tdl_net='0';	
				}
				if($("#tdl_org").is(':checked')){
				 var tdl_org='1';	
				}else {
				 var tdl_org='0';	
				}
			    if($("#tdl_io").is(':checked')){
				 var tdl_io='1';	
				}else {
				 var tdl_io='0';	
				}
				 if($("#cell_number").is(':checked')){
				 var cell_number='1';	
				}else {
				 var cell_number='0';	
				}
				 if($("#landline").is(':checked')){
				 var landline='1';	
				}else {
				 var landline='0';	
				}
			
			 var use_template_all=$("#use_template_all").val();
             var content_for_sendingemail_all=$("#content_for_sendingemail_all").val();

			  $.ajax({
               type:'POST',
               url:'sendemail_all',
               beforeSend: function()
					{
						$('#msg_for_emailpart_all').html('<span align="center"><img src="theme/images/loading.gif">sending...</span>');
					},
              data:'domain_name='+domain_name+'&registrant_country='+registrant_country+'&tdl_com='+tdl_com+'&tdl_net='+tdl_net+'&tdl_org='+tdl_org+'&tdl_io='+tdl_io+'&cell_number='+cell_number+'&landline='+landline+'&datepicker='+datepicker+'&domains_for_export='+domains_for_export_id+'&domains_for_export_allChecked='+domains_for_export_id_allChecked+'&registrant_state='+registrant_state+'&use_template_all='+use_template_all+'&content_for_sendingemail_all='+content_for_sendingemail_all,
               success:function(data){
               	if(data=='success'){
               		$("#use_mail_template_for_all").prop( "checked", false);
                    $("#content_for_sendingemail_all").val('');
                    $("#msg_for_emailpart_all").html('Mail sent');
               	}
               
                 
               }
            });

			
            
            
          
    });      
  var domains = [];
  
   $('.downloadcsv_all').click(function(event){
   
        $("#domains_for_export_id").val('');
        domains = [];
	    if($(this).is(':checked')) {
	      $(".eachrow_download").prop( "checked", true);
	      $("#domains_for_export_id_allChecked").val(1);
	    } else {
	       $(".eachrow_download").prop( "checked", false);
	       $("#domains_for_export_id_allChecked").val(0);
	    }
        
	    
	   
	   
  });

  $('.eachrow_download').click(function(event){
   $("#domains_for_export_id_allChecked").val(0);
   $(".downloadcsv_all").prop( "checked", false);
   var id=$(this).attr('id');
   
	    if($("#"+id).is(':checked')) {
	    domains.push(id);
	    } else {
	   
	    var x = domains.indexOf(id);
         domains.splice(x,1);
	    }
        
	    
	     $("#domains_for_export_id").val(domains);
	   
  });

 </script>
  <script>
		/*==================== PAGINATION =========================*/

		$(window).on('hashchange',function(){
			page = window.location.hash.replace('#','');
			getDomainLeads(page);
		});

		$(document).on('click','.pagination a', function(e){
			e.preventDefault();
			var page = $(this).attr('href').split('page=')[1];
			// getProducts(page);
			location.hash = page;
		});

		function getDomainLeads(page){
			var domain_name=$("#domain_name").val();
			var registrant_country=$("#registrant_country").val();
			var datepicker=$("#datepicker").val();
			var domains_for_export_id=$("#domains_for_export_id").val();
			var domains_for_export_id_allChecked=$("#domains_for_export_id_allChecked").val();
			var registrant_state=$("#registrant_state").val();
			
				if($("#tdl_com").is(':checked')){
				 var tdl_com='1';	
				}else {
				 var tdl_com='0';	
				}
				if($("#tdl_net").is(':checked')){
				 var tdl_net='1';	
				}else {
				 var tdl_net='0';	
				}
				if($("#tdl_org").is(':checked')){
				 var tdl_org='1';	
				}else {
				 var tdl_org='0';	
				}
			    if($("#tdl_io").is(':checked')){
				 var tdl_io='1';	
				}else {
				 var tdl_io='0';	
				}
				 if($("#cell_number").is(':checked')){
				 var cell_number='1';	
				}else {
				 var cell_number='0';	
				}
				 if($("#landline").is(':checked')){
				 var landline='1';	
				}else {
				 var landline='0';	
				}
			
			
			
			$.ajax({
				url: 'ajax/search?page=' + page,
				beforeSend: function()
					{
						$('.content').html('<span align="center"><img src="theme/images/loader.gif"></span>');
					},
				data:'domain_name='+domain_name+'&registrant_country='+registrant_country+'&tdl_com='+tdl_com+'&tdl_net='+tdl_net+'&tdl_org='+tdl_org+'&tdl_io='+tdl_io+'&cell_number='+cell_number+'&landline='+landline+'&datepicker='+datepicker+'&domains_for_export_id='+domains_for_export_id+'&domains_for_export_id_allChecked='+domains_for_export_id_allChecked+'&registrant_state='+registrant_state,
			}).done(function(data){
				$('.content').html(data);
			});
		}

	</script>
  <script>
  function unlockleadsfun(key,leads_id,domain_id){
   var user_id='<?php echo Auth::user()->id?>';
   $(".unpaid_td"+key).hide();
   $(".paid_td"+key).show();
   $("#unlockleads"+key).attr('disabled', true);
   $.ajax({
               type:'POST',
               url:'insertUserLeads',
               beforeSend: function()
					{
						//$('#filtereddataid').html('<img src="theme/images/loading.gif">Loading...');
					},
               data:'user_id='+user_id+'&leads_id='+leads_id+'&domain_id='+domain_id,
	               success:function(data){
	               	
	                 
	               }
                });
  }
   
    
  
  $(function() {
  	
  	
     $( "#datepicker" ).datepicker();
     $( "#datepicker" ).datepicker( "option", "dateFormat", 'yy-mm-dd');
     var create_date='<?php echo Input::get('create_date'); ?>';
     if(create_date!=''){
     	$( "#datepicker" ).val(create_date);
     }
  });
  </script>
  <script type="text/javascript">
     
        $("#submitbtn").click(function(){
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
  </script>
	  <style  type="text/css">
	a.tooltip2 {outline:none; }
	a.tooltip2 strong {line-height:30px;}
	a.tooltip2:hover {text-decoration:none;} 
	a.tooltip2 span {
	    z-index:10;display:none; padding:14px 20px;
	    margin-top:-30px; margin-left:28px;
	    width:300px; line-height:16px;
	}
	a.tooltip2:hover span{
	    display:inline; position:absolute; color:#111;
	    border:1px solid #DCA; background:#fffAF0;}
	.callout {z-index:20;position:absolute;top:30px;border:0;left:-12px;}
	    
	a.tooltip span
	{
	    border-radius:4px;
	    box-shadow: 5px 5px 8px #CCC;
	}

	</style>

</html>