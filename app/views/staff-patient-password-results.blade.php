@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('staff-logout') }}">Log out</a></p>
	<p><a href="{{ URL::to('/') }}">Dashboard</a></p>
	
	<h1>Password Reset</h1>
	
	<p>The password for patient {{ $unique }} has been reset.</p>
	
	<table border="1">
		<tr>
			<th>Patient ID</th>
			<th>Password</th>
		</tr>
		<tr>
			<td>{{ $unique }}</td>
			<td>{{ $password }}</td>
		</tr>
	</table>
	
	<p><a href="{{ URL::to('/') }}">Return to the dashboard</a></p>
@stop