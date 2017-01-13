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
  <h2>Search Result</h2>
    <input type="hidden" id="filteredemail"  value=""> 
    <div id="filtereddataid">     
  <table class="table">
    <thead>
      <tr>
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
        $domainName_new =$value->domain_name;
        }
        ?>
	      <tr>
	        <td><a href="http://{{ $value->domain_name }}" target="_blank">{{ $domainName_new}}</a></td>
	        <td>{{ $value->registrant_name}}</td>
	        <td>{{ $value->registrant_email}}</td>
	        <td>{{ $value->registrant_phone}}</td>
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
  
  $(function() {
  	
  	
     $( "#datepicker" ).datepicker();
     $( "#datepicker" ).datepicker( "option", "dateFormat", 'yy-mm-dd');
     var create_date='<?php echo Input::get('create_date'); ?>';
     if(create_date!=''){
     	$( "#datepicker" ).val(create_date);
     }
  });
  </script>

</html>