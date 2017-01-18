


		{!! Html::style('resources/assets/css/bootstrap.css') !!}
		{!! Html::style('resources/assets/css/jquery.dataTables.css') !!}
		{!! Html::script('resources/assets/js/jquery-1.12.0.js') !!}
		{!! Html::script('resources/assets/js/jquery.dataTables.js') !!}
		

				<table class="table table-hover table-bordered product22">
					<thead>
					<th>ID</th>
					<th>Name</th>
					<th>Price</th>
					<th>Action</th>
					</thead>
					<tbody>



					@foreach($products as $product)
					<tr>
					<td>{{$product->id}}</td>
					<td>{{$product->name}}</td>
					<td>{{$product->price}}</td>
					<td>{!! Form ::open ([
					                'method'=>'delete',
					                'route'=>['product.destroy',$product->id]
									])!!}

					{!!Form::submit('Delete')!!}

					<a href="{{route('product.edit',$product->id)}}">Edit</a>
					{!! Form::close()!!}</td>
					</tr>
					@endforeach
					</tbody>
				</table>
			
<script type="text/javascript">
$(document).ready(function(){
$('.product22').DataTable({

  select:true,
  "order":[[0,"desc"]],
  "paging" :true,
  "bProcessing":true
  
});
});
</script>


