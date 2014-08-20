@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<nav>
		<ul>
			<li><a href="{{ URL::to('/') }}">Dashboard</a></li>
			<li>Add Patient</li>
		</ul>
	</nav>
	
	<h1>Patient Added</h1>
	
	<table>
		<tr>
			<th>Patient ID</th>
			<th>Password</th>
		</tr>
		<tr>
			<td class="text-mono">{{ $unique_id }}</td>
			<td class="text-mono">{{ $password }}</td>
		</tr>
	</table>
	
	<p><a href="{{ URL::to('/') }}">Return to the dashboard</a></p>
@stop