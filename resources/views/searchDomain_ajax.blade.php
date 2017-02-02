
     
        <div id="checkavailableleadsid"></div>   
		 <table class="table table-hover table-bordered domainDAta">
		    <thead>
		      <tr>
		        <th><input type="checkbox"  value="1" class="downloadcsv_all" id="" <?php if($domains_for_export_id_allChecked=='1'){echo "checked";}else {echo "";} ?>></th>
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
				    //dd($leadusersData);
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
			        '{{$value->registrant_name}}' , '{{$value->create_date}}','{{$value->unlocked_num}}')" value="1" <?php echo $disabled;?>>

                    <div class="paid_td{{$key}}" <?php echo $style_paid;?> ><input type="checkbox" name="downloadcsv" class="eachrow_download" value="1" id="{{$value->domain_id}}" <?php if ((in_array($value->domain_id, $req_domainsforexport)) || ($domains_for_export_id_allChecked=='1')) {echo "checked"; }else { echo "";}?>></div>

			        </td>

			        <td>
				        <div class="unpaid_td{{$key}}" <?php echo $style_unpaid;?>><a href="<?php  if (Auth::user()->user_type=='2'){ ?>http://{{ $value->domain_name }}" <?php } else { ?>javascript:void(0); <?php  } ?> target="_blank">{{ $domainName_new}}</a></div>
	                     <div class="paid_td{{$key}}" <?php echo $style_paid;?> ><a href="http://{{ $value->domain_name }}" target="_blank">{{ $value->domain_name}}</a>
                          
	                     </div>
	                     <small id="unlocked{{$key}}">Unlocked : {{$value->unlocked_num == null ? 0 : $value->unlocked_num}} times</small>
	                     <br>
	                     <small id="domain_count"> Total Domains: {{$value->domainCount}}</small>
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
			        @if(in_array($value->leads_id, $leadusersData))
			        <span id="show_date{{$key}}">{{$value->create_date}}</span>
			        @else
			        <span id="show_date{{$key}}">****/**/**</span>
			        @endif

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
		{{$requiredData->links()}}  
		 
 <script>
  //var domains = [];
  
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
 