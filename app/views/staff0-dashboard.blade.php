@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('staff-logout') }}">Log out</a></p>

	<p>This is the clinician dashboard.</p>
	
	{{ Form::open(array('url' => 'clinician')) }}
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		
		<ul>
			<li>
				{{ Form::text('unique_id', Session::get('patient', null), array('required', 'maxlength' => '10', 'pattern' => '\d+', 'placeholder' => 'Patient ID')) }} {{ Form::submit('Select') }}
			</li>
		</ul>
	{{ Form::close() }}
	
	@if (isset($option))
		<p><a href="{{ URL::to('assessment') }}">{{ $option }}</a></p>
	@endif
@stop