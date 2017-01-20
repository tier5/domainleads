
     
        <div id="checkavailableleadsid"></div>   
		  <table class="table table-hover table-bordered domainDAta">
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
			        <td><input type="radio" name="unlockleads{{$key}}" id="unlockleads{{$key}}" <?php echo $checked;?> onclick="unlockleadsfun('<?php echo $key; ?>','<?php echo $value->leads_id; ?>','<?php echo $value->domain_id; ?>')" value="1" <?php echo $disabled;?>>
                    <div class="paid_td{{$key}}" <?php echo $style_paid;?> ><input type="checkbox" name="downloadcsv" value="1"></div>
			        </td>
			        <td >
				        <div class="unpaid_td{{$key}}" <?php echo $style_unpaid;?>><a href="<?php  if (Auth::user()->user_type=='2'){ ?>http://{{ $value->domain_name }}" <?php } else { ?>javascript:void(0); <?php  } ?> target="_blank">{{ $domainName_new}}</a></div>
	                     <div class="paid_td{{$key}}" <?php echo $style_paid;?> ><a href="http://{{ $value->domain_name }}" target="_blank">{{ $value->domain_name}}</a></div>
			        </td>

			        

			        <td>{{ $value->registrant_name}}</td>
			        <td>{{ $value->registrant_email}}<a href="getDomainData/{{base64_encode($value->registrant_email)}}" target="_blank"><button class="btn btn-success">View</button></a></td>

			        <td>
			            <div class="unpaid_td{{$key}}" <?php echo $style_unpaid;?>><?php echo $phonenumber;?></div>
				        <div class="paid_td{{$key}}" <?php echo $style_paid;?> ><a href="#" <?php echo $class;?>><?php echo $phonenumber;?><span <?php echo $option ;?> > <img class="callout" src="theme/images/Callout.gif" />
	                    <table><tr><td>Phone No:<?php echo $value->phone_number;?></td><td>State: <?php echo $value->state;?></td><td>City :<?php echo $value->major_city;?></td></tr></table> </span></a></div>
                    </td>

                     

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
		   
			
			
		    </tbody>
		     
		  </table>
		{{$requiredData->links()}}  
		 
 
 