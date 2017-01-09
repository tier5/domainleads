@extends('layouts.layout')
@section('title')
{{$product->name}}
@stop

@section('body')
{!! Form ::open ([
                'method'=>'delete',
                'route'=>['product.destroy',$product->id]
				])!!}
<h1>{{$product['name']}}</h1>
<h1>{{$product->price}}</h1>
{!!Form::submit('Delete')!!}

<a href="{{route('product.edit',$product->id)}}">Edit</a>
{!! Form::close()!!}
@stop

