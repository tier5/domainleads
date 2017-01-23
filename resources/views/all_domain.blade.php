<!DOCTYPE html>

<html>
<head>
	<title>All Domain</title>
</head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>

<body>

	<p>All domain names for email address <b>{{$email}}</b></p>

	<u>Total count : {{count($alldomain)}}</u>

	<div>
		<table>
		
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
						
						{{$domain->registrant_company}}
					</td>
				</tr>

				@endforeach
				  		
			  	
			</tr>
		</table>
	</div>
</body>
</html>