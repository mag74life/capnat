@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('logout') }}">Log out</a></p>
	<p><a href="{{ URL::to('/') }}">Dashboard</a></p>

	<h1>Survey Results</h1>
	
	<table>
		@for ($i = 0; $i < Config::get('app.surveyLength'); $i++)
			<tr>
				<td>{{ $questions[$i]->question }}</td>
				<td>{{ $results['survey_q' . $i] }}</td>
			</tr>
		@endfor
	</table>
	<table>
		<tr>
			<td style="text-align: right;">Sensory Scale:</td>
			<td>{{ $results['survey_scale0'] }}</td>
		</tr>
		<tr>
			<td style="text-align: right;">Motor Scale:</td>
			<td>{{ $results['survey_scale1'] }}</td>
		</tr>
		<tr>
			<td style="text-align: right;">Autonomic Scale:</td>
			<td>{{ $results['survey_scale2'] }}</td>
		</tr>
		<tr>
			<td style="text-align: right;">Total:</td>
			<td>{{ $results['survey_total'] }}</td>
		</tr>
	</table>
	
	<p><a href="{{ URL::to('/') }}">Return to the dashboard</a></p>
@stop