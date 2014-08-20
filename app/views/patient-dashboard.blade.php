@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<nav>
		<ul>
			<li>Dashboard</li>
		</ul>
	</nav>
	
	<h1>Hello, {{{$name}}}</h1>
	
	<p>
		@if ($newSurvey)
			<a class="button-link" href="{{ URL::to('survey') }}">Start a new survey</a>
		@else
			A new survey cannot be started at this time.
		@endif
	</p>
	
	@if (!$exams->isEmpty())
		<h2>Completed Surveys</h2>
		
		<table>
			<tr>
				<th>Score</th>
				<th>Completed On</th>
				<th class="no-border no-background"></th>
			</tr>
			@foreach ($exams as $exam)
				<tr>
					<td class="align-right">{{ $exam->survey_total }}</td>
					<td>{{ date('F j, Y', strtotime($exam->updated_at)) }}</td>
					<td class="no-border no-background">
						@if ($exam->id == $reviseExam)
							<a href="{{ URL::to('survey/revise') }}">Revise</a>
						@endif
					</td>
				</tr>
			@endforeach
		</table>
	@endif
	
@stop