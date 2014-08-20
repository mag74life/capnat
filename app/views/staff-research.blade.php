@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<nav>
		<ul>
			<li><a href="{{ URL::to('/') }}">Dashboard</a></li>
			<li>Research Data</li>
		</ul>
	</nav>
	
	<h1>Research Data</h1>
	
	<p>Enter criteria to narrow your search. All fields are optional.</p>
	
	{{ Form::open(array('url' => 'research')) }}
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		
		<ul class="form-fields">
			<li>
				{{ Form::label('unique_id', 'Patient ID', array('class' => 'field-label-side')) }}
				{{ Form::text('unique_id', null, array('class' => 'textfield-mini', 'maxlength' => '10', 'pattern' => '\d+')) }}
			</li>
			<li>
				{{ Form::label('name', 'Name', array('class' => 'field-label-side')) }}
				{{ Form::text('name', null, array('class' => 'textfield-medium', 'maxlength' => '60')) }}
			</li>
			<li>
				{{ Form::label('dob', 'Date of Birth', array('class' => 'field-label-side')) }}
				{{ Form::text('dob', null, array('class' => 'textfield-mini', 'pattern' => '\d{1,2}/\d{1,2}/\d{4}', 'maxlength' => '10', 'placeholder' => 'MM/DD/YYYY')) }}
			</li>
			<li>
				{{ Form::label('gender', 'Gender', array('class' => 'field-label-side')) }}
				{{ Form::select('gender', $genderOptions, null, array('class' => 'textfield-mini')) }}
			</li>
			<li>
				{{ Form::label('race', 'Race', array('class' => 'field-label-side')) }}
				{{ Form::select('race', $raceOptions, null, array('class' => 'textfield-short')) }}
			</li>
			<li>
				{{ Form::label('ethnicity', 'Ethnicity', array('class' => 'field-label-side')) }}
				{{ Form::select('ethnicity', $ethnicityOptions, null, array('class' => 'textfield-short')) }}
			</li>
			<li>
				{{ Form::label('education', 'Education', array('class' => 'field-label-side')) }}
				{{ Form::select('education', $educationOptions, null, array('class' => 'textfield-medium')) }}
			</li>
			<li class="button-side">
				{{ Form::submit('Search') }}
			</li>
		</ul>
	{{ Form::close() }}
	
	@if (isset($results))
		@if (!$results->isEmpty())
			<h2>Search Results</h2>
			
			<table>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Date of Birth</th>
					<th>Gender</th>
					<th>Race</th>
					<th>Ethnicity</th>
					<th>Education</th>
					<th class="no-border no-background"></th>
				</tr>
				@foreach ($results as $row)
					<tr>
						<td>{{ $row->id }}</td>
						<td>{{ $row->name }}</td>
						<td>{{ $row->dob }}</td>
						<td>{{ $row->gender }}</td>
						<td>{{ $row->race }}</td>
						<td>{{ $row->ethnicity }}</td>
						<td>{{ $row->education }}</td>
						<td class="no-border no-background"><a href="{{ URL::to('patient/' . $row->id) }}">View</a></td>
					</tr>
				@endforeach
			</table>
		@else
			<p>The selected query returned no results.</p>
		@endif
	@endif
	
@stop