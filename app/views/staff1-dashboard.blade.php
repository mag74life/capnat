@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('staff-logout') }}">Log out</a></p>

	<p>This is the research staff dashboard.</p>
	
	<ul>
		<li><a href="{{ URL::to('add-patient') }}">Add Patient</a></li>
		<li><a href="{{ URL::to('remove-patient') }}">Remove Patient</a></li>
		<li><a href="{{ URL::to('patient-password') }}">Reset Patient Password</a></li>
	</ul>
@stop