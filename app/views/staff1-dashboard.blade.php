@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<nav>
		<ul>
			<li>Dashboard</li>
		</ul>
	</nav>
	
	<ul class="button-list">
		<li><a href="{{ URL::to('add-patient') }}">Add Patient</a></li>
		<li><a href="{{ URL::to('remove-patient') }}">Remove Patient</a></li>
		<li><a href="{{ URL::to('patient-password') }}">Reset Patient Password</a></li>
	</ul>
@stop