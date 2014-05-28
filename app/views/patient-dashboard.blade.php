@extends('layouts.master')

<?php
	$user = Auth::user();
	$patient = $user->userData;
	$name = $patient->name;
?>

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('logout') }}">Log out</a></p>
	
	<h1>Welcome, {{{$name}}}</h1>

	<p>This is the patient dashboard.</p>
@stop