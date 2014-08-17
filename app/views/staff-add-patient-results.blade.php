@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('staff-logout') }}">Log out</a></p>
	<p><a href="{{ URL::to('/') }}">Dashboard</a></p>
	
	<h1>Patient Added</h1>
	
	<table border="1">
		<tr>
			<th>Patient ID</th>
			<th>Password</th>
		</tr>
		<tr>
			<td>{{ $unique_id }}</td>
			<td>{{ $password }}</td>
		</tr>
	</table>
	
	<p><a href="{{ URL::to('/') }}">Return to the dashboard</a></p>
@stop