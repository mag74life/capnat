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

	<h1>Assessment</h1>
	
	{{ Form::model($assessment, array('route' => $route)) }}
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		
		<ul class="form-fields">
			<li>
				<div class="field-desc">{{ $questions[0] }}</div>
				{{ Form::radioGroup('assessment_q0', $choices[0], array('required')) }}
			</li>
			<li>
				<div class="field-desc">{{ $questions[1] }}</div>
				{{ Form::radioGroup('assessment_q1', $choices[1], array('required')) }}
			</li>
			<li>
				<div class="field-desc">{{ $questions[2] }}</div>
				{{ Form::radioGroup('assessment_q2', $choices[2], array('required')) }}
			</li>
			<li>
				<div class="field-desc">{{ $questions[3] }}</div>
				{{ Form::select('assessment_q3', $choices[3], array('required')) }}
			</li>
			<li>
				<div class="field-desc">{{ $questions[4] }}</div>
				{{ Form::radioGroup('assessment_q4', $choices[4], array('required')) }}
			</li>
			<li>
				<div class="field-desc">{{ $questions[5] }}</div>
				{{ Form::radioGroup('assessment_q5', $choices[5], array('required')) }}
			</li>
			<li>
				{{ Form::submit('Submit') }}
			</li>
		</ul>
	{{ Form::close() }}
@stop