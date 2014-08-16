@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	{{ Form::open(array('url' => 'staff-login')) }}
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		
		<ul>
			<li>
				{{-- Form::label('unique', 'Uniquename') --}}
				{{ Form::text('unique', null, array('placeholder' => 'Uniquename')) }}
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

	<p><a href="{{ URL::to('login') }}">Patient Login</a></p>
@stop