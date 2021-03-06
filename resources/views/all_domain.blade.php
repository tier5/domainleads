<!DOCTYPE html>
@include('layouts.header')
<html>
<head>
	<title>All Domain</title>
</head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    
        {!! Html::style('resources/assets/css/bootstrap.css') !!}
		
		{!! Html::script('resources/assets/js/jquery-1.12.0.js') !!}
		
		
		{!! Html::script('resources/assets/js/bootstrap.js') !!}
<body>

	<div class="col-md-10" style="padding-left:85px"> 
		
	

	<p>All domain names for email address <b>{{$email}}</b></p>

	<u>Total count : {{count($alldomain)}}</u>

	<div>
		<table class="table table-hover table-bordered domainDAta">
		
			<tr>
				<tr>
					<th>SL no</th>
				    <th>Domain Name</th>
				    <th>Registrant Name</th>
				    <th>Registrant Email</th>
				    <th>Registrant Phone</th>
				    <th>Date</th>
				    <th>Registrant Company</th>
			  	</tr>

			  	<?php $x = 1; ?>

		  		@foreach($alldomain as $domain)

		  		<tr>
		  			<td>{{$x++}}</td>
			  		<td>
						{{$domain->domain_name}}
					</td>
					<td>
						
						{{$domain->registrant_name}}
					</td>
					<td>
						
						{{$domain->registrant_email}}
					</td>
					<td>
						
						{{$domain->registrant_phone}}
					</td>
					<td>
						
						{{$domain->created_at}}
					</td>
					<td>

						@if($domain->registrant_company == null)
							<img src="{{url('/')}}/public/images/userimg.png" style="width:30px; height:30px">
						@else
						{{$domain->registrant_company}}
						@endif
					</td>
				</tr>

				@endforeach
				  		
			  	
			</tr>
		</table>
	</div>

	</div>
</body>
</html>