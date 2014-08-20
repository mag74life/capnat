@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<nav>
		<ul>
			<li><a href="{{ URL::to('/') }}">Dashboard</a></li>
			<li><a href="{{ URL::to('research') }}">Research Data</a></li>
			<li><a href="{{ URL::to('patient/' . $patientId) }}">Patient #{{ $patientId }}</a></li>
			<li>Exam #{{ $exam->id }}</li>
		</ul>
	</nav>
	
	<h1>Exam Data for Patient #{{ $patientId }}, {{ $patientName }}</h1>
	
	<p>Exam completed on {{ date('F j, Y', strtotime($exam->updated_at)) }}</p>
	
	<h2>Survey</h2>
	<table>
		@for ($i = 0; $i < count($survey); $i++)
			<tr>
				<td>{{ $survey[$i]['question'] }}</td>
				<td>{{ $exam['survey_q' . $i] }}</td>
			</tr>
		@endfor
	</table>
	<table class="float-right align-right">
		<tr>
			<td style="text-align: right;">Sensory Scale:</td>
			<td>{{ $exam['survey_scale0'] }}</td>
		</tr>
		<tr>
			<td style="text-align: right;">Motor Scale:</td>
			<td>{{ $exam['survey_scale1'] }}</td>
		</tr>
		<tr>
			<td style="text-align: right;">Autonomic Scale:</td>
			<td>{{ $exam['survey_scale2'] }}</td>
		</tr>
		<tr>
			<td class="total">Total:</td>
			<td class="total">{{ $exam['survey_total'] }}</td>
		</tr>
	</table>
	<div class="clearfix"></div>
	
	<h2>Assessment</h2>
	@if ($exam['assessment_total'] !== null)
		<table>
			@for ($i = 0; $i < count($assessment); $i++)
				<tr>
					<td>{{ $assessment[$i] }}</td>
					<td>
						@if ($exam['assessment_q' . $i] == 99)
							Unable to assess
						@else
							{{ $exam['assessment_q' . $i] }}
						@endif
					</td>
				</tr>
			@endfor
			<tr>
				<td class="total align-right">Total:</td>
				<td class="total">{{ $exam['assessment_total'] }}</td>
			</tr>
		</table>
	@else
		<p>Assessment has not been completed.</p>
	@endif
	
@stop