@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('staff-logout') }}">Log out</a></p>

	<p>This is the staff dashboard.</p>
	
	<ul>
		<li><a href="{{ URL::to('create-patient') }}">Create Patient</a></li>
		<li><a href="{{ URL::to('view-patients') }}">View Patient Data</a></li>
	</ul>
@stop