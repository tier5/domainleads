@foreach($products as $product)
	<h3>{{$product->name}}</h3>
@endforeach

{{$products->links()}}
