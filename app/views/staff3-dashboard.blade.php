@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('staff-logout') }}">Log out</a></p>

	<p>This is the head researcher dashboard.</p>
	
	<ul>
		<li><a href="{{ URL::to('add-patient') }}">Add Patient</a></li>
		<li><a href="{{ URL::to('remove-patient') }}">Remove Patient</a></li>
		<li><a href="{{ URL::to('patient-password') }}">Reset Patient Password</a></li>
		<li><a href="{{ URL::to('patient-lookup') }}">Patient Lookup</a></li>
		<li><a href="{{ URL::to('add-clinician') }}">Add Clinician</a></li>
		<li><a href="{{ URL::to('remove-clinician') }}">Remove Clinician</a></li>
		<li><a href="{{ URL::to('add-staff') }}">Add Research Staff</a></li>
		<li><a href="{{ URL::to('remove-staff') }}">Remove Research Staff</a></li>
		<li><a href="{{ URL::to('view-patients') }}">View Patient Data</a></li>
	</ul>
@stop