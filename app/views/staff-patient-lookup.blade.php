@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('staff-logout') }}">Log out</a></p>
	<p><a href="{{ URL::to('/') }}">Dashboard</a></p>
	
	<h1>Patient Lookup</h1>
	
	<p>Enter criteria to narrow your search. All fields are optional.</p>
	
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
				{{ Form::select('gender', $genderOptions) }}
			</li>
			<li>
				{{ Form::label('race', 'Race') }}
				{{ Form::select('race', $raceOptions) }}
			</li>
			<li>
				{{ Form::label('ethnicity', 'Ethnicity') }}
				{{ Form::select('ethnicity', $ethnicityOptions) }}
			</li>
			<li>
				{{ Form::submit('Search') }}
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
					<td>{{ $genderOptions[$row->gender] }}</td>
					<td>{{ $raceOptions[$row->race] }}</td>
					<td>{{ $ethnicityOptions[$row->ethnicity] }}</td>
				</tr>
			@endforeach
		</table>
	@else
		<p>The selected query returned no results.</p>
	@endif
@stop