@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<nav>
		<ul>
			<li><a href="{{ URL::to('/') }}">Dashboard</a></li>
			<li>Remove Research Staff</li>
		</ul>
	</nav>
	
	<h1>Research Staff Removed</h1>
	
	<p>Research staff {{ $unique_id }} has been removed.</p>
	
	<p><a href="{{ URL::to('/') }}">Return to the dashboard</a></p>
@stop