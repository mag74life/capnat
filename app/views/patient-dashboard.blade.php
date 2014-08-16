@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('logout') }}">Log out</a></p>
	
	<h1>Welcome, {{{$name}}}</h1>

	<p>This is the patient dashboard.</p>
	
	@if ($option != NULL)
		<p><a href="{{ URL::to('survey') }}">{{ $option }}</a></p>
	@endif
	
	@if (!$exams->isEmpty())
		<h2>Completed surveys:</h2>
		
		<table border="1">
			<tr>
				<th>Score</th>
				<th>Completed At</th>
			</tr>
			@foreach ($exams as $exam)
				<tr>
					<td>{{ $exam->survey_total }}</td>
					<td>{{ $exam->created_at }}</td>
				</tr>
			@endforeach
		</table>
	@endif
	
@stop