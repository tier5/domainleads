<html lang="en">
@include('layouts.header')
<head>

	<title>Search Domain</title>
	 
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    
        {!! Html::style('resources/assets/css/bootstrap.css') !!}
        {!! Html::style('resources/assets/css/view.css') !!}
		
		{!! Html::script('resources/assets/js/jquery-1.12.0.js') !!}
		
		
		{!! Html::script('resources/assets/js/bootstrap.js') !!}
       
</head>

<body>



		<div class="container-fluid container">

			<div class="navbar-header">

				<a class="navbar-brand" href="#">Search Domain</a>  

                @if(Session::has('msg'))
                {{ Session::get('msg')}}
                @endif

                <a class="navbar-brand" href="{{url('/')}}/myleads">My leads</a>
			</div>
		</div>
	
	<div class="container">
	<div class="row">
	<div class="col-md-8">
		<form class="form" style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('postSearchData') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Domain Name</label>
				<input type="text" name="domain_name" class="form-control" id="domain_name" value="{{ Input::get('domain_name') }}" />
			</div>
			<div class="form-group">
				<label>Registrant Country</label>
				<input type="text" name="registrant_country" id="registrant_country" class="form-control" value="{{ Input::get('registrant_country') }}" />
			</div>
			<div class="form-group">
				<label>Registered Date</label>
				<input type="text" name="create_date" id="datepicker" class="form-control" value="{{ Input::get('create_date') }}" />
			</div>
			<div class="form-group">
				<label>State</label>
				<input type="text" class="form-control" name="registrant_state" id="registrant_state" value="{{ Input::get('registrant_state') }}"> 
            </div>
            <div class="form-group">
            <label>.com</label><input type="checkbox" name="tdl_com" id="tdl_com" value='1' <?php if(Input::get('tdl_com')==1) { echo "checked";} ?>>
            <label>.net</label><input type="checkbox" name="tdl_net" id="tdl_net" value='1' <?php if(Input::get('tdl_net')==1) { echo "checked";} ?>>
            <label>.org</label><input type="checkbox" name="tdl_org" id="tdl_org" value='1'<?php if(Input::get('tdl_org')==1) { echo "checked";} ?>>
            <label>.io</label><input type="checkbox" name="tdl_io" id="tdl_io" value='1' <?php if(Input::get('tdl_io')==1) { echo "checked";} ?>>
            <label>Cell Number</label><input type="checkbox" name="cell_number" id="cell_number" value='1' <?php if(Input::get('cell_number')==1) { echo "checked";} ?>>
            <label>Landline Number</label><input type="checkbox" name="landline" id="landline" value='1' <?php if(Input::get('landline')==1) { echo "checked";} ?>>
            </div>
            <div class="form-group">
				<button class="btn btn-primary">Search</button>
			</div>

		</form>

		<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('downloadExcel') }}" class="form-horizontal" method="get" enctype="multipart/form-data">
         <input type="hidden" name="domains_for_export" id="domains_for_export_id" value="">
         <input type="hidden" name="domains_for_export_allChecked" id="domains_for_export_id_allChecked" value="0">
		 <button class="btn btn-primary" id="exportID">Export</button>

		</form>
		</div>
		<div class="col-md-4"></div>
 	</div>
		



		
	<div class="container">
	
    <h2>Search Result</h2>
    <h3>Total leads : {{$total_leads}}</h3>
    <h3>Used leads : <span id="used_leads_id">{{$used_leads}}</span></h3>
  
    <input type="hidden" id="filteredemail"  value=""> 
    <div id="filtereddataid" class="content">  
   
        <div id="checkavailableleadsid"></div>   
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
		     

            <?php $i = 0; ?>
		      @if(count($requiredData))  
				@foreach($requiredData as $key=>$value)
		         
				    <?php 
				    if (Auth::user()->user_type=='1')
				    {
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
				  //  dd($leadusersData);
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
			        <input type="radio" name="unlockleads{{$key}}" id="unlockleads{{$key}}" <?php echo $checked;?> onclick="unlockleadsfun('<?php echo $key; ?>','<?php echo $value->leads_id; ?>','<?php echo $value->domain_id; ?>','{{$value->registrant_email}}' , 
			        '{{$value->registrant_name}}' , '{{$value->create_date}}' , '{{$value->unlocked_num}}')" value="1" <?php echo $disabled;?>>

                    <div class="paid_td{{$key}}" <?php echo $style_paid;?> ><input type="checkbox" name="downloadcsv" value="1" class="eachrow_download" id="{{$value->domain_id}}"></div>

			        </td>

			        <td>
				        <div class="unpaid_td{{$key}}" <?php echo $style_unpaid;?>><a href="<?php  if (Auth::user()->user_type=='2'){ ?>http://{{ $value->domain_name }}" <?php } else { ?>javascript:void(0); <?php  } ?> target="_blank">{{ $domainName_new}}</a></div>
	                     <div class="paid_td{{$key}}" <?php echo $style_paid;?> ><a href="http://{{ $value->domain_name }}" target="_blank">{{ $value->domain_name}}</a></div>

	                     <br>


	                     
	                    
	                     <small id="unlocked{{$key}}">Unlocked : {{$value->unlocked_num == null ? 0 : $value->unlocked_num}} times</small>
	                     <br>
	                     <small id="domain_count"> Total Domains: <a href="/all_domain/{{base64_encode($value->registrant_email)}}">{{$count_domain[$value->registrant_email]}}</a></small>
	                     
	                     
			        </td>

			      
			        <td>

			        @if(in_array($value->leads_id, $leadusersData))
			        <span id="show_name{{$key}}">{{ $value->registrant_name}}</span>
			        	
			        @else
			        	<?php
			        		$s = $value->registrant_name;
			        		for($i = 1 ; $i < strlen($s)-1 ; $i++)
			        		{
			        			$s[$i] = '*';
			        		}
			        	?>
			        <span id="show_name{{$key}}">{{$s}}</span>
			        @endif

			        </td>

			        <td>
			        @if(in_array($value->leads_id, $leadusersData))
			         	<span id="show_email{{$key}}">{{ $value->registrant_email}}</span>
			         	<br>
			        	<!-- <a href="/all_domain/{{base64_encode($value->registrant_email)}}">Other domains</a> -->
			        	<a id="view{{$key}}"  href="getDomainData/{{base64_encode($value->registrant_email)}}" target="_blank"><button class="btn btn-success">View</button></a>
			        @else
			        	<?php
			        		$s = $value->registrant_email;
			        		$s = explode('@', $s);
			        		$ss = $s[0];
			        		for($i = 1 ; $i < strlen($ss)-1 ; $i++)
			        		{
			        			$ss[$i] = '*';
			        		}

			        	?>
			        <span id="show_email{{$key}}">{{$ss}}</span>
			        <a id="view{{$key}}" style="display:none" href="getDomainData/{{base64_encode($value->registrant_email)}}" target="_blank"><button class="btn btn-success">View</button></a>
			        @endif

			        
			        </td>

			        <td>
			            <div class="unpaid_td{{$key}}" <?php echo $style_unpaid;?>><?php echo $phonenumber;?></div>
				        <div class="paid_td{{$key}}" <?php echo $style_paid;?> ><a href="#" <?php echo $class;?>><?php echo $phonenumber;?><span <?php echo $option ;?> > <img class="callout" src="theme/images/Callout.gif" />
	                    <table><tr><td>Phone No:<?php echo $value->phone_number;?></td><td>State: <?php echo $value->state;?></td><td>City :<?php echo $value->major_city;?></td></tr></table> </span></a></div>
                    </td>

                     

			        <td>
			        	<span id="show_date{{$key}}">{{$value->create_date}}</span>
			        </td>
			        <td>

			        	@if($value->registrant_company != null)
			        		<img src="{{url('/')}}/public/images/company.png" style="width:30px; height:30px">
			        	@else
			        		<img src="{{url('/')}}/public/images/userimg.png" style="width:30px; height:30px">
			        	@endif

			        </td>
			        
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

</body>

 <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script>
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
				data:'domain_name='+domain_name+'&registrant_country='+registrant_country+'&tdl_com='+tdl_com+'&tdl_net='+tdl_net+'&tdl_org='+tdl_org+'&tdl_io='+tdl_io+'&cell_number='+cell_number+'&landline='+landline+'&datepicker='+datepicker+'&domains_for_export_id='+domains_for_export_id+'&domains_for_export_id_allChecked='+domains_for_export_id_allChecked+'&registrant_state='+registrant_state,
			}).done(function(data){
				$('.content').html(data);
			});
		}

	</script>
  
  <script>
  function unlockleadsfun(key,leads_id,domain_id,email,name,date,unlocked_num)
  {

   var total_leads='<?php echo $total_leads?>';
   var user_id='<?php echo Auth::user()->id?>';
   
   $.ajax({
               type:'POST',
               url:'insertUserLeads',
               beforeSend: function()
					{
						//$('#filtereddataid').html('<img src="theme/images/loading.gif">Loading...');
					},
               data:'user_id='+user_id+'&leads_id='+leads_id+'&domain_id='+domain_id+'&total_leads='+total_leads,
	               success:function(data){
	               	  if(data=='false'){
						
                        $("#unlockleads"+key).prop('checked',false);
                        //$("#checkavailableleadsid").html("You have used all leads!!!");
                        alert("You have used all leads!!!");
	               	  }else{
	               	  	$(".unpaid_td"+key).hide();
						$(".paid_td"+key).show();
						$("#unlockleads"+key).attr('disabled', true);
						$("#used_leads_id").text(data);

						$('#show_name'+key).text(name);
						$('#show_email'+key).text(email);
						$('#show_date'+key).text(date);
						$('#unlocked'+key).text('Unlocked : '+(unlocked_num+1).toString());
						$('#view'+key).show();	
	               	  }

	                 
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