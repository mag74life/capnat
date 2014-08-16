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
				<ol>
					<li>{{ Form::radio('gender', 0, null, array('required', 'id' => 'gender-0')) }} {{ Form::label('gender-0', 'Male') }}</li>
					<li>{{ Form::radio('gender', 1, null, array('id' => 'gender-1')) }} {{ Form::label('gender-1', 'Female') }}</li>
					<li>{{ Form::radio('gender', 2, null, array('id' => 'gender-2')) }} {{ Form::label('gender-2', 'Other') }}</li>
				</ol>
			</li>
			<li>
				<div>Race</div>
				<ol>
					<li>{{ Form::radio('race', 0, null, array('required', 'id' => 'race-0')) }} {{ Form::label('race-0', 'Caucasian') }}</li>
					<li>{{ Form::radio('race', 1, null, array('id' => 'race-1')) }} {{ Form::label('race-1', 'African American') }}</li>
					<li>{{ Form::radio('race', 2, null, array('id' => 'race-2')) }} {{ Form::label('race-2', 'Native American') }}</li>
					<li>{{ Form::radio('race', 3, null, array('id' => 'race-3')) }} {{ Form::label('race-3', 'Asian') }}</li>
					<li>{{ Form::radio('race', 4, null, array('id' => 'race-4')) }} {{ Form::label('race-4', 'Latino/Hispanic') }}</li>
					<li>{{ Form::radio('race', 5, null, array('id' => 'race-5')) }} {{ Form::label('race-5', 'Multiracial') }}</li>
					<li>{{ Form::radio('race', 6, null, array('id' => 'race-6')) }} {{ Form::label('race-6', 'Other') }}</li>
				</ol>
			</li>
			<li>
				<div>Ethnicity</div>
				<ol>
					<li>{{ Form::radio('ethnicity', 0, null, array('required', 'id' => 'ethnicity-0')) }} {{ Form::label('ethnicity-0', 'Hispanic') }}</li>
					<li>{{ Form::radio('ethnicity', 1, null, array('id' => 'ethnicity-1')) }} {{ Form::label('ethnicity-1', 'Non-Hispanic') }}</li>
				</ol>
			</li>
			<li>
				<div>Highest level of education completed</div>
				<ol>
					<li>{{ Form::radio('education', 0, null, array('required', 'id' => 'education-0')) }} {{ Form::label('education-0', 'Less than high school') }}</li>
					<li>{{ Form::radio('education', 1, null, array('id' => 'education-1')) }} {{ Form::label('education-1', 'Some high school') }}</li>
					<li>{{ Form::radio('education', 2, null, array('id' => 'education-2')) }} {{ Form::label('education-2', 'Graduated from high school') }}</li>
					<li>{{ Form::radio('education', 3, null, array('id' => 'education-3')) }} {{ Form::label('education-3', 'Some college') }}</li>
					<li>{{ Form::radio('education', 4, null, array('id' => 'education-4')) }} {{ Form::label('education-4', 'Completed an undergraduate associate degree') }}</li>
					<li>{{ Form::radio('education', 5, null, array('id' => 'education-5')) }} {{ Form::label('education-5', 'Completed an undergraduate bachelors degree') }}</li>
					<li>{{ Form::radio('education', 6, null, array('id' => 'education-6')) }} {{ Form::label('education-6', 'Some graduate school') }}</li>
					<li>{{ Form::radio('education', 7, null, array('id' => 'education-7')) }} {{ Form::label('education-7', 'Completed a masters degree') }}</li>
					<li>{{ Form::radio('education', 8, null, array('id' => 'education-8')) }} {{ Form::label('education-8', 'Completed a doctoral degree') }}</li>
				</ol>
			</li>
			<li>
				{{ Form::submit('Submit') }}
			</li>
		</ul>
	{{ Form::close() }}
@stop