@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<nav>
		<ul>
			<li><a href="{{ URL::to('/') }}">Dashboard</a></li>
			<li>Survey</li>
		</ul>
	</nav>

	<h1>Survey Results</h1>
	
	<table>
		@for ($i = 0; $i < count($questions); $i++)
			<tr>
				<td>{{ $questions[$i]['question'] }}</td>
				<td>{{ $results['survey_q' . $i] }}</td>
			</tr>
		@endfor
	</table>
	<table class="float-right align-right">
		<tr>
			<td>Sensory Scale:</td>
			<td>{{ $results['survey_scale0'] }}</td>
		</tr>
		<tr>
			<td>Motor Scale:</td>
			<td>{{ $results['survey_scale1'] }}</td>
		</tr>
		<tr>
			<td>Autonomic Scale:</td>
			<td>{{ $results['survey_scale2'] }}</td>
		</tr>
		<tr>
			<td class="total">Total:</td>
			<td class="total">{{ $results['survey_total'] }}</td>
		</tr>
	</table>
	<div class="clearfix"></div>
	
	<p><a href="{{ URL::to('/') }}">Return to the dashboard</a></p>
@stop