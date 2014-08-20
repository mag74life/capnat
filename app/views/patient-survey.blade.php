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

	<h1>Survey</h1>
	
	{{ Form::model($exam, array('route' => $route)) }}
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		
		<ul class="form-fields">
			@for ($i = 0; $i < count($questions); $i++)
				<li>
					<div class="field-desc">{{ $questions[$i]['question'] }}</div>
					{{ Form::radioGroup('survey_q' . $i, $choices, array('required')) }}
				</li>
			@endfor
			<li>
				{{ Form::submit('Submit') }}
			</li>
		</ul>
	{{ Form::close() }}
@stop