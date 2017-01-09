@extends('layouts.layout')
@section('title')
Create new Products
@stop

@section('body')
{!! Form ::open (['route'=>'product.store'])!!}


    {!! Form::label('Category') !!}

{!! Form::select('cat_id', $categories) !!}	

{{ Form ::label('name','Name')}}
{!! Form::text('name')!!}

{{ Form ::label('price','Price')}} 
{!! Form::text('price')!!}
{!! Form::submit('Create')!!}
{!! Form::close()!!}
@stop

