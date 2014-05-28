@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('logout') }}">Log out</a></p>

	<h1>Survey</h1>
	
	{{ Form::open(array('url' => 'survey')) }}
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		
		<ul>
			<li>
				<p>Did you have tingling fingers or hands?</p>
				<ol>
					<li>{{ Form::radio('q1', '0', null, array('id' => 'q1-1')) }} {{ Form::label('q1-1', 'Not at all') }}</li>
					<li>{{ Form::radio('q1', '1', null, array('id' => 'q1-2')) }} {{ Form::label('q1-2', 'A little') }}</li>
					<li>{{ Form::radio('q1', '2', null, array('id' => 'q1-3')) }} {{ Form::label('q1-3', 'Quite a bit') }}</li>
					<li>{{ Form::radio('q1', '3', null, array('id' => 'q1-4')) }} {{ Form::label('q1-4', 'Very much') }}</li>
				</ol>
			</li>
			<li>
				<p>Did you have tingling toes of feet?</p>
				<ol>
					<li>{{ Form::radio('q2', '0', null, array('id' => 'q2-1')) }} {{ Form::label('q2-1', 'Not at all') }}</li>
					<li>{{ Form::radio('q2', '1', null, array('id' => 'q2-2')) }} {{ Form::label('q2-2', 'A little') }}</li>
					<li>{{ Form::radio('q2', '2', null, array('id' => 'q2-3')) }} {{ Form::label('q2-3', 'Quite a bit') }}</li>
					<li>{{ Form::radio('q2', '3', null, array('id' => 'q2-4')) }} {{ Form::label('q2-4', 'Very much') }}</li>
				</ol>
			</li>
			<li>
				<p>Did you have numbness in your fingers or hands?</p>
				<ol>
					<li>{{ Form::radio('q3', '0', null, array('id' => 'q3-1')) }} {{ Form::label('q3-1', 'Not at all') }}</li>
					<li>{{ Form::radio('q3', '1', null, array('id' => 'q3-2')) }} {{ Form::label('q3-2', 'A little') }}</li>
					<li>{{ Form::radio('q3', '2', null, array('id' => 'q3-3')) }} {{ Form::label('q3-3', 'Quite a bit') }}</li>
					<li>{{ Form::radio('q3', '3', null, array('id' => 'q3-4')) }} {{ Form::label('q3-4', 'Very much') }}</li>
				</ol>
			</li>
			<li>
				<p>Did you have numbness in your toes or feet?</p>
				<ol>
					<li>{{ Form::radio('q4', '0', null, array('id' => 'q4-1')) }} {{ Form::label('q4-1', 'Not at all') }}</li>
					<li>{{ Form::radio('q4', '1', null, array('id' => 'q4-2')) }} {{ Form::label('q4-2', 'A little') }}</li>
					<li>{{ Form::radio('q4', '2', null, array('id' => 'q4-3')) }} {{ Form::label('q4-3', 'Quite a bit') }}</li>
					<li>{{ Form::radio('q4', '3', null, array('id' => 'q4-4')) }} {{ Form::label('q4-4', 'Very much') }}</li>
				</ol>
			</li>
			<li>
				{{ Form::submit('Submit') }}
			</li>
		</ul>
	{{ Form::close() }}
@stop