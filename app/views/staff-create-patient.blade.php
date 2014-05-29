@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('staff-logout') }}">Log out</a></p>
	<p><a href="{{ URL::to('/') }}">Dashboard</a></p>

	<h1>Create Patient</h1>
	
	{{ Form::open(array('url' => 'create-patient')) }}
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		
		<ul>
			<li>
				{{ Form::label('name', 'Name') }}
				{{ Form::text('name', null, array('maxlength' => '60')) }}
			</li>
			<li>
				{{ Form::submit('Create') }}
			</li>
		</ul>
	{{ Form::close() }}
@stop