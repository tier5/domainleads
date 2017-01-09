@extends('layouts.layout')
@section('title')
All Products
@stop

@section('body')

		{!! Html::style('resources/assets/css/bootstrap.css') !!}
		{!! Html::style('resources/assets/css/jquery.dataTables.css') !!}
		{!! Html::script('resources/assets/js/jquery-1.12.0.js') !!}
		{!! Html::script('resources/assets/js/jquery.dataTables.js') !!}
		
	<style type="text/css">
	.wrapper{
	width: 75%;
	margin:0 auto;
	background: #eee;
	margin-top:10px;
	}
	</style>
	<div class="wrapper">	
<section class="panel-primary">
<div class="panel-heading">
<b>Listing</b>
</div>
<div class="panel-body">
<table class="table table-hover table-bordered product">
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
</div>
</section>
  </div>
<script type="text/javascript">
$(document).ready(function(){
$('.product').DataTable({

  select:true,
  "order":[[0,"desc"]],
  "paging" :true,
  "bProcessing":true
  
});
});
</script>
@stop

