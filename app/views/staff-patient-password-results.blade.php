@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<nav>
		<ul>
			<li><a href="{{ URL::to('/') }}">Dashboard</a></li>
			<li>Reset Patient Password</li>
		</ul>
	</nav>
	
	<h1>Password Reset</h1>
	
	<p>The password for patient {{ $unique_id }} has been reset.</p>
	
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