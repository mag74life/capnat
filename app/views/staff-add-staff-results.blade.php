@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('staff-logout') }}">Log out</a></p>
	<p><a href="{{ URL::to('/') }}">Dashboard</a></p>
	
	<h1>Research Staff Added</h1>
	
	<p>The user "{{ $unique_id }}" has been added to the database as a research staff.</p>
	
	<p><a href="{{ URL::to('/') }}">Return to the dashboard</a></p>
@stop