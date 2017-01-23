<html lang="en">
@include('layouts.header')
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
	<title>domainleads | My Links</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	{!! Html::style('resources/assets/css/bootstrap.css') !!}
		{!! Html::style('resources/assets/css/jquery.dataTables.css') !!}
		{!! Html::script('resources/assets/js/jquery-1.12.0.js') !!}
		{!! Html::script('resources/assets/js/jquery.dataTables.js') !!}
	<body>
		<section>
		
			<div class="col-md-10" style="padding-left:85px">

				<h4>
				<small><u>MY  LEADS</u></small> 

				<small class="pull-right">TOTAL : {{sizeof($myleads)}}</small>
				</h4>
				
		    	@if(isset($myleads) && $myleads != null)         
				
				<table class="table table-hover table-bordered domainDAta">


					<tr>
						<th>Domain Name</th>
						<th>Administrative name</th>
						<th>Administrative address</th>
						<th>Administrative email</th>
						<th>Name_Server_1</th>
					</tr>

					@foreach($myleads as $key=>$each)

					<tr>
						<td>
							
								{{ $myleads[$key]['domain_name'] }}
							
				        </td>


				        <td>
				        	
					        {{ $myleads[$key]['administrative_name'] }}
				        	
				        </td>
				        
				        <td> 
				        
				        	
					        {{ $myleads[$key]['administrative_address'] }}
					        
				        
				        </td>
			        
			        	<td>
				        
				        	
				        	
					        {{ $myleads[$key]['administrative_email'] }}
				        	
				        
				        </td>
				        <td>
				        
				        	
				        	{{ $myleads[$key]['name_server1_'] }}
				        	
				        
				        </td>
					</tr>
					@endforeach
				</table>
				
				@endif
			</div>
		</section>
	</body>
</head>
</html>