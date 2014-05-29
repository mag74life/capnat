@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('logout') }}">Log out</a></p>
	<p><a href="{{ URL::to('/') }}">Dashboard</a></p>

	<h1>Survey Results</h1>
	
	<p>The score is {{ $surveyScore }}.</p>
	
	<p><a href="{{ URL::to('/') }}">Return to the dashboard</a></p>
@stop