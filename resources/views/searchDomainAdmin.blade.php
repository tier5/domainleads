<html lang="en">
@include('layouts.header')
<head>

	<title>Search Domain</title>
	 

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
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

			<button class="btn btn-primary">Search</button>

		</form>
		
	<div class="container">
	<?php 

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, "https://textinbulk.com/app/api/validate-us-phone-number");
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 0);
	  

	$data = array(
	    'phone_number' => '8123904629'
	   
	);

	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

	$contents = curl_exec($ch);
    $err = curl_error($ch);
	curl_close($ch);
	//$json = json_decode($contents, true);
	//print_r($json['http_code']);
	//$response = curl_exec($curl);
	

	//curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	  echo $contents;
	}




	?>
    <h2>Search Result</h2>
    <input type="hidden" id="filteredemail"  value=""> 
    <div id="filtereddataid">     
		  <table class="table">
		    <thead>
		      <tr>
		        <th></th>
		        <th>Domain Name</th>
		        <th>Registrant Name</th>
		        <th>Registrant Email</th>
		        <th>Registrant Phone</th>
		        <th>Registered Date</th>
		        <th>Registrant Company</th>
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
						}
						else
						{
						  $style_unpaid='style="display: block;"';
						  $style_paid='style="display: none;"';
						  $checked='';
						}
                         $ph_code='';
                         $ph_number='';
						 $ph_code=strstr($value->registrant_phone, '.', true);
						 $ph_number=substr(strrchr($value->registrant_phone, "."), 1);
						$http_code='';
						if($ph_code=='1'){
							 $ch = curl_init();

							curl_setopt($ch, CURLOPT_URL, "https://www.textinbulk.com/app/api/validate-us-phone-number");
							curl_setopt($ch, CURLOPT_HEADER, 0);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($ch, CURLOPT_POST, 1);
							curl_setopt($ch, CURLOPT_TIMEOUT, 0);

							$data = array(
							    'phone_number' => $ph_number
							   
							);

							curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

							$contents = curl_exec($ch);

							curl_close($ch);
							$json = json_decode($contents, true);
							//print_r($json['validation_status']);
							$http_code=$json['http_code'];
							if($http_code=='200'){

                               $number_type=$json['phone_number_details']['number_type'];
                                  if($number_type=='Landline'){
                                    $phonenumber="<img src='theme/images/landline.png' width='25'>";
                                  }else {
                                    $phonenumber="<img src='theme/images/cellnumber.png' width='40'>";
                                  }
                             
							}else {
                               $phonenumber="<img src='theme/images/nophone.png' width='56'>";
							}
							
						}else
						{
							$phonenumber=$value->registrant_phone;
						}
				    ?>
			      <tr>
			        <td><input type="radio" name="unlockleads{{$key}}" id="unlockleads{{$key}}" <?php echo $checked;?> onclick="unlockleadsfun('<?php echo $key; ?>','<?php echo $value->leads_id; ?>','<?php echo $value->domain_id; ?>')" value="1"></td>
			        <td class="unpaid_td{{$key}}" <?php echo $style_unpaid;?>><a href="<?php  if (Auth::user()->user_type=='2'){ ?>http://{{ $value->domain_name }}" <?php } else { ?>javascript:void(0); <?php  } ?> target="_blank">{{ $domainName_new}}</a></td>
			        <td class="paid_td{{$key}}" <?php echo $style_paid;?>><a href="http://{{ $value->domain_name }}" target="_blank">{{ $value->domain_name}}</a></td>
			        <td>{{ $value->registrant_name}}</td>
			        <td>{{ $value->registrant_email}}<a href="getDomainData/{{base64_encode($value->registrant_email)}}" target="_blank"><button class="btn btn-success">View</button></a></td>
			        <td><a href="#" class="tooltip2"><?php echo $http_code;?><span> <img class="callout" src="theme/images/Callout.gif" />
                    <strong>blah blah</strong><br />or blah blah. </span></a></td>
			        <td>{{ $value->create_date}}</td>
			        <td>{{ $value->registrant_company}}</td>
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

			      </tr>
		        @endforeach
		    @else <tr><td colspan="4"><p>No Result Found !!!</p></td></tr>
			@endif 
			
		    </tbody>
		     
		  </table>
  </div>
   
</div> 
		
</div>

</body>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script>
  function unlockleadsfun(key,leads_id,domain_id){
   var user_id='<?php echo Auth::user()->id?>';
   $(".unpaid_td"+key).hide();
   $(".paid_td"+key).show();
   $.ajax({
               type:'POST',
               url:'insertUserLeads',
               beforeSend: function()
					{
						//$('#filtereddataid').html('<img src="theme/images/loading.gif">Loading...');
					},
               data:'user_id='+user_id+'&leads_id='+leads_id+'&domain_id='+domain_id,
	               success:function(data){
	               	//$("#filtereddataid").html(data);
	                //console.log(data);
	                 
	               }
                });
  }
   
    
  function filterFunction(email){
  	var domain_name=$("#domain_name").val();
  	var registrant_country=$("#registrant_country").val();
  	var datepicker=$("#datepicker").val();
    var filteredemail=$("#filteredemail").val();
	     if(filteredemail==''){
	      filteredemail=email;
	     }else {
	      filteredemail=filteredemail+","+email;
	     } 
        $("#filteredemail").val(filteredemail);

        $.ajax({
               type:'POST',
               url:'filteremailID',
               beforeSend: function()
					{
						$('#filtereddataid').html('<img src="theme/images/loading.gif">Loading...');
					},
               data:'domain_name='+domain_name+'&registrant_country='+registrant_country+'&datepicker='+datepicker+'&filteredemail='+filteredemail,
	               success:function(data){
	               	$("#filtereddataid").html(data);
	                //console.log(data);
	                 
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