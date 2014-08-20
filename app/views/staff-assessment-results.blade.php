@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<nav>
		<ul>
			<li><a href="{{ URL::to('/') }}">Dashboard</a></li>
			<li>Assessment</li>
		</ul>
	</nav>

	<h1>Assessment Results</h1>
	
	<table>
		@for ($i = 0; $i < count($questions); $i++)
			<tr>
				<td>{{ $questions[$i] }}</td>
				<td>{{ $results['assessment_q' . $i] }}</td>
			</tr>
		@endfor
		<tr>
			<td class="total align-right">Total:</td>
			<td class="total">{{ $results['assessment_total'] }}</td>
		</tr>
	</table>
	
	<p><a href="{{ URL::to('/') }}">Return to the dashboard</a></p>
@stop