@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('logout') }}">Log out</a></p>
	
	<h1>Welcome, {{{$name}}}</h1>

	<p>This is the patient dashboard.</p>
	
	<p>
		@if ($newSurvey)
			<a href="{{ URL::to('survey') }}">Start a new survey</a>
		@else
			A new survey cannot be started at this time.
		@endif
	</p>
	
	@if (!$exams->isEmpty())
		<h2>Completed surveys:</h2>
		
		<table border="1">
			<tr>
				<th>Score</th>
				<th>Completed At</th>
				<th></th>
			</tr>
			@foreach ($exams as $exam)
				<tr>
					<td>{{ $exam->survey_total }}</td>
					<td>{{ $exam->updated_at }}</td>
					<td>
						@if ($exam->id == $reviseExam)
							<a href="{{ URL::to('survey/revise') }}">Revise</a>
						@endif
					</td>
				</tr>
			@endforeach
		</table>
	@endif
	
@stop