@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<nav>
		<ul>
			<li><a href="{{ URL::to('/') }}">Dashboard</a></li>
			<li>Remove Clinician</li>
		</ul>
	</nav>
	
	<h1>Clinician Removed</h1>
	
	<p>Clinician {{ $unique_id }} has been removed.</p>
	
	<p><a href="{{ URL::to('/') }}">Return to the dashboard</a></p>
@stop