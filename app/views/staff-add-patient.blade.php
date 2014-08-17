@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('staff-logout') }}">Log out</a></p>
	<p><a href="{{ URL::to('/') }}">Dashboard</a></p>

	<h1>Add Patient</h1>
	
	{{ Form::open(array('url' => 'add-patient')) }}
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		
		<ul>
			<li>
				{{ Form::label('name', 'Name') }}
				{{ Form::text('name', null, array('required', 'maxlength' => '60')) }}
			</li>
			<li>
				{{ Form::label('dob', 'Date of Birth') }}
				{{ Form::text('dob', null, array('required', 'pattern' => '\d{1,2}/\d{1,2}/\d{4}', 'maxlength' => '10', 'placeholder' => 'MM/DD/YYYY')) }}
			</li>
			<li>
				<div>Gender</div>
				{{ Form::radioGroup( 'gender', $genderOptions, array('required') ) }}
			</li>
			<li>
				<div>Race</div>
				{{ Form::radioGroup( 'race', $raceOptions, array('required') ) }}
			</li>
			<li>
				<div>Ethnicity</div>
				{{ Form::radioGroup( 'ethnicity', $ethnicityOptions, array('required') ) }}
			</li>
			<li>
				<div>Highest level of education completed</div>
				{{ Form::radioGroup( 'education', $educationOptions, array('required') ) }}
			</li>
			<li>
				{{ Form::submit('Submit') }}
			</li>
		</ul>
	{{ Form::close() }}
@stop