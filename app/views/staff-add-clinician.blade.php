@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<nav>
		<ul>
			<li><a href="{{ URL::to('/') }}">Dashboard</a></li>
			<li>Add Clinician</li>
		</ul>
	</nav>

	<h1>Add Clinician</h1>
	
	{{ Form::open(array('url' => 'add-clinician')) }}
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		
		<ul class="form-fields">
			<li>
				{{ Form::label('unique_id', 'Uniquename', array('class' => 'field-label-side')) }}
				{{ Form::text('unique_id', null, array('class' => 'textfield-mini', 'required', 'pattern' => '[a-z]+')) }}
			</li>
			<li class="button-side">
				{{ Form::submit('Submit') }}
			</li>
		</ul>
	{{ Form::close() }}
@stop