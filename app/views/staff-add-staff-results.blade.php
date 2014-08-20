@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<nav>
		<ul>
			<li><a href="{{ URL::to('/') }}">Dashboard</a></li>
			<li>Add Research Staff</li>
		</ul>
	</nav>
	
	<h1>Research Staff Added</h1>
	
	<p>The user "{{ $unique_id }}" has been added to the database as a research staff.</p>
	
	<p><a href="{{ URL::to('/') }}">Return to the dashboard</a></p>
@stop