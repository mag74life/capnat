@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('logout') }}">Log out</a></p>
	<p><a href="{{ URL::to('/') }}">Dashboard</a></p>

	<h1>Survey</h1>
	
	{{ Form::model($exam, array('route' => 'survey')) }}
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		
		<ul>
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