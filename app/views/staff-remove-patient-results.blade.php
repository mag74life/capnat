@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('staff-logout') }}">Log out</a></p>
	<p><a href="{{ URL::to('/') }}">Dashboard</a></p>
	
	<h1>Patient Removed</h1>
	
	<p>Patient {{ $unique }} has been removed.</p>
	
	<p><a href="{{ URL::to('/') }}">Return to the dashboard</a></p>
@stop