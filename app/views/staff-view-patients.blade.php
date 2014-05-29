@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('staff-logout') }}">Log out</a></p>
	<p><a href="{{ URL::to('/') }}">Dashboard</a></p>
	
	<h1>Patient Data</h1>
	
	@foreach ($patients as $patient)
		<h2>{{ $patient['name'] }}</h2>
		
		@if (count($patient['exams']) > 0)
			<table border="1">
				<tr>
					<th>Survey Score</th>
					<th>Completed At</th>
				</tr>
				@foreach ($patient['exams'] as $exam)
					<tr>
						<td>{{ $exam->survey_score }}</td>
						<td>{{ $exam->created_at }}</td>
					</tr>
				@endforeach
			</tr>
			</table>
		@else
			<p>No exams on record.</p>
		@endif
	@endforeach
	
@stop