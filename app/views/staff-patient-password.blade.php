@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('staff-logout') }}">Log out</a></p>
	<p><a href="{{ URL::to('/') }}">Dashboard</a></p>

	<h1>Reset Patient Password</h1>
	
	{{ Form::open(array('url' => 'patient-password')) }}
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		
		<ul>
			<li>
				{{ Form::label('unique', 'Patient ID') }}
				{{ Form::text('unique', null, array('required', 'maxlength' => '10', 'pattern' => '\d+')) }}
			</li>
			<li>
				{{ Form::submit('Submit') }}
			</li>
		</ul>
	{{ Form::close() }}
@stop