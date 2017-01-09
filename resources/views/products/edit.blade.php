@extends('layouts.layout')
@section('title')
Edit{{$product->name}}
@stop

@section('body')
{!! Form ::model ($product,[
                           'method'=>'patch',
                           'route'=>['product.update',$product->id]
						   ])!!}
 {!! Form::label('Category') !!}

{!! Form::select('cat_id', $categories) !!}	
						   
{{ Form ::label('name','Name')}}
{!! Form::text('name',$product->name)!!}

{{ Form ::label('price','Price')}} 
{!! Form::text('price',$product->price)!!}
{!! Form::submit('Create')!!}
{!! Form::close()!!}
@stop

