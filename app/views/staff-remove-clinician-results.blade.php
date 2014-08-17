@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('staff-logout') }}">Log out</a></p>
	<p><a href="{{ URL::to('/') }}">Dashboard</a></p>
	
	<h1>Clinician Removed</h1>
	
	<p>Clinician {{ $unique_id }} has been removed.</p>
	
	<p><a href="{{ URL::to('/') }}">Return to the dashboard</a></p>
@stop