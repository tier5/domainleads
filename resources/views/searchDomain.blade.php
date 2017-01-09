<html lang="en">

<head>

	<title>Search Domain</title>
	 

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >

</head>

<body>

	<nav class="navbar navbar-default">

		<div class="container-fluid">

			<div class="navbar-header">

				<a class="navbar-brand" href="#">Search Domain</a>  <a href="{{ URL::to('importExport') }}"> ImportCSV</a>
                @if(Session::has('msg'))
                {{ Session::get('msg')}}
                @endif
			</div>

		</div>

	</nav>

	<div class="container">

		<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('postSearchData') }}" class="form-horizontal" method="post" enctype="multipart/form-data">

			Domain Name<input type="text" name="domain_name" value="{{ Input::get('domain_name') }}" />
			Registrant Country<input type="text" name="registrant_country" value="{{ Input::get('registrant_country') }}" />

			<button class="btn btn-primary">Search</button>

		</form>
		
		    
		
		@foreach($requiredData as $key=>$value)
		{{ $key }} 
		{{ $value->email}}   <br/>                  
		@endforeach
	</div>

</body>

</html>