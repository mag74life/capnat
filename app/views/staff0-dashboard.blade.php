@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('staff-logout') }}">Log out</a></p>

	<p>This is the clinician dashboard.</p>
	
	<ul>
		<li><a href="{{ URL::to('assessment') }}">Assessment</a></li>
	</ul>
@stop