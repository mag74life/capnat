@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<nav>
		<ul>
			<li><a href="{{ URL::to('/') }}">Dashboard</a></li>
			<li>Add Clinician</li>
		</ul>
	</nav>
	
	<h1>Clinician Added</h1>
	
	<p>The user "{{ $unique_id }}" has been added to the database as a clinician.</p>
	
	<p><a href="{{ URL::to('/') }}">Return to the dashboard</a></p>
@stop