@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<?php
		$gender = array(
			0 => 'Male',
			1 => 'Female',
			2 => 'Other',
		);
		$race = array(
			0 => 'Caucasian',
			1 => 'African American',
			2 => 'Native American',
			3 => 'Asian',
			4 => 'Latino/Hispanic',
			5 => 'Multiracial',
			6 => 'Other',
		);
		$ethnicity = array(
			0 => 'Hispanic',
			1 => 'Non-Hispanic',
		);
	?>

	<p><a href="{{ URL::to('staff-logout') }}">Log out</a></p>
	<p><a href="{{ URL::to('/') }}">Dashboard</a></p>

	<h1>Patient Lookup</h1>
	
	{{ Form::open(array('url' => 'patient-lookup')) }}
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
				{{ Form::label('dob', 'Date of Birth') }}
				{{ Form::text('dob', null, array('pattern' => '\d{1,2}/\d{1,2}/\d{4}', 'maxlength' => '10', 'placeholder' => 'MM/DD/YYYY')) }}
			</li>
			<li>
				{{ Form::label('gender', 'Gender') }}
				{{ Form::select('gender', array(
					'' => '',
					0 => 'Male',
					1 => 'Female',
					2 => 'Other',
				)) }}
			</li>
			<li>
				{{ Form::label('race', 'Race') }}
				{{ Form::select('race', array(
					'' => '',
					0 => 'Caucasian',
					1 => 'African American',
					2 => 'Native American',
					3 => 'Asian',
					4 => 'Latino/Hispanic',
					5 => 'Multiracial',
					6 => 'Other',
				)) }}
			</li>
			<li>
				{{ Form::label('ethnicity', 'Ethnicity') }}
				{{ Form::select('ethnicity', array(
					'' => '',
					0 => 'Hispanic',
					1 => 'Non-Hispanic',
				)) }}
			</li>
			<li>
				{{ Form::submit('Submit') }}
			</li>
		</ul>
	{{ Form::close() }}
	
	@if (!empty($results) && !$results->isEmpty())
		<h2>Search Results:</h2>
		
		<table border="1">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Date of Birth</th>
				<th>Gender</th>
				<th>Race</th>
				<th>Ethnicity</th>
			</tr>
			@foreach ($results as $row)
				<tr>
					<td>{{ $row->id }}</td>
					<td>{{ $row->name }}</td>
					<td>{{ $row->dob }}</td>
					<td>{{ $gender[$row->gender] }}</td>
					<td>{{ $race[$row->race] }}</td>
					<td>{{ $ethnicity[$row->ethnicity] }}</td>
				</tr>
			@endforeach
		</table>
	@endif
@stop