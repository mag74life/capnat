@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('logout') }}">Log out</a></p>

	<p>This is the staff dashboard.</p>
@stop