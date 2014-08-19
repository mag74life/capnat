@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('staff-logout') }}">Log out</a></p>
	<p><a href="{{ URL::to('/') }}">Dashboard</a></p>

	<h1>Assessment</h1>
	
	{{ Form::model($assessment, array('route' => $route)) }}
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		
		<ul>
			<li>
				<p>{{ $questions[0] }}</p>
				{{ Form::radioGroup('assessment_q0', $choices[0], array('required')) }}
			</li>
			<li>
				<p>{{ $questions[1] }}</p>
				{{ Form::radioGroup('assessment_q1', $choices[1], array('required')) }}
			</li>
			<li>
				<p>{{ $questions[2] }}</p>
				{{ Form::radioGroup('assessment_q2', $choices[2], array('required')) }}
			</li>
			<li>
				<p>{{ $questions[3] }}</p>
				{{ Form::select('assessment_q3', $choices[3], array('required')) }}
			</li>
			<li>
				<p>{{ $questions[4] }}</p>
				{{ Form::radioGroup('assessment_q4', $choices[4], array('required')) }}
			</li>
			<li>
				<p>{{ $questions[5] }}</p>
				{{ Form::radioGroup('assessment_q5', $choices[5], array('required')) }}
			</li>
			<li>
				{{ Form::submit('Submit') }}
			</li>
		</ul>
	{{ Form::close() }}
@stop