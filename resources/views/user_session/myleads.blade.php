<html lang="en">
@include('layouts.header')
<head>
	<title>domainleads | My Links</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	{!! Html::style('resources/assets/css/bootstrap.css') !!}
		{!! Html::style('resources/assets/css/jquery.dataTables.css') !!}
		{!! Html::script('resources/assets/js/jquery-1.12.0.js') !!}
		{!! Html::script('resources/assets/js/jquery.dataTables.js') !!}
	<body>
		<section>
		<h4 class="center">My Leads</h4>
			<div>
		    		        
				@foreach($myleads as $key=>$each)
				<table class="table table-hover table-bordered domainDAta">

					<tr class="col-md-10">
						<td class="col-md-2">
							<div>
								<label>Domain Name</label>
								<span> {{ $myleads[$key]['domain_name'] }}</span>
							</div>
				        </td>


				        <td class="col-md-2">
				        	<div>
				        	<label>Administrative name</label>
					        <span> {{ $myleads[$key]['administrative_name'] }}</span>
				        	</div>
				        </td>
				        
				        <td class="col-md-2"> 
				        <div>
				        <label>Administrative address</label>
				        	<div>
					        <span> {{ $myleads[$key]['administrative_address'] }}</span> 
					        </div>
				        </div>
				        </td>
			        
			        	<td class="col-md-2">
				        <div>
				        	<label>Administrative email</label>
				        	<div>
					        <span> {{ $myleads[$key]['administrative_email'] }}</span>
				        	</div>
				        </div>
				        </td>
				        <td class="col-md-2">
				        <div>
				        	<label>Name_Server_1</label>
				        	<div>
					        <span> {{ $myleads[$key]['name_server1_'] }}</span>
				        	</div>
				        </div>
				        </td>
					</tr>
					
				</table>
				@endforeach
			</div>
		</section>
	</body>
</head>
</html>