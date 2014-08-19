@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('staff-logout') }}">Log out</a></p>
	<p><a href="{{ URL::to('/') }}">Dashboard</a></p>

	<h1>Assessment Results</h1>
	
	<table>
		@for ($i = 0; $i < count($questions); $i++)
			<tr>
				<td>{{ $questions[$i] }}</td>
				<td>{{ $results['assessment_q' . $i] }}</td>
			</tr>
		@endfor
		<tr>
			<td style="text-align: right;">Total:</td>
			<td>{{ $results['assessment_total'] }}</td>
		</tr>
	</table>
	
	<p><a href="{{ URL::to('/') }}">Return to the dashboard</a></p>
@stop