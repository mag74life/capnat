@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p>Patients, please log in below to begin your survey.</p>

	{{ Form::open(array('url' => 'login')) }}
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		
		<ul>
			<li>
				{{-- Form::label('unique_id', 'Patient ID') --}}
				{{ Form::text('unique_id', null, array('maxlength' => '10', 'placeholder' => 'Patient ID')) }}
			</li>
			<li>
				{{-- Form::label('password', 'Password') --}}
				{{ Form::password('password', array('placeholder' => 'Password')) }}
			</li>
			<li>
				{{ Form::submit('Log in') }}
			</li>
		</ul>
	{{ Form::close() }}

	<p><a href="{{ URL::to('staff-login') }}">Staff Login</a></p>
@stop
