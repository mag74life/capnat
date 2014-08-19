@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('staff-logout') }}">Log out</a></p>
	<p><a href="{{ URL::to('/') }}">Dashboard</a></p>

	<h1>Assessment</h1>
	
	{{ Form::model($exam, array('route' => 'assessment')) }}
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		
		<ul>
			<li>
				<p>Tingling</p>
				{{ Form::radioGroup('assessment_q0', $choices[0], array('required')) }}
			</li>
			<li>
				<p>Numbness</p>
				{{ Form::radioGroup('assessment_q1', $choices[1], array('required')) }}
			</li>
			<li>
				<p>Neuropathic pain (burning, shooting, aching, stabbing)</p>
				{{ Form::radioGroup('assessment_q2', $choices[2], array('required')) }}
			</li>
			<li>
				<p>Rate your neuropathic pain (0 = No pain, 10 = Pain as bad as you can imagine)</p>
				{{ Form::select('assessment_q3', array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10), array('required')) }}
			</li>
		
			@for ($i = 0; $i < count($questions); $i++)
				<li>
					<p>{{ $questions[$i]['question'] }}</p>
					{{ Form::radioGroup('survey_q' . $i, $choices, array('required')) }}
				</li>
			@endfor
			<li>
				{{ Form::submit('Submit') }}
			</li>
		</ul>
	{{ Form::close() }}
@stop