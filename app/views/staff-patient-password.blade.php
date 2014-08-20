@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<nav>
		<ul>
			<li><a href="{{ URL::to('/') }}">Dashboard</a></li>
			<li>Reset Patient Password</li>
		</ul>
	</nav>

	<h1>Reset Patient Password</h1>
	
	{{ Form::open(array('url' => 'patient-password')) }}
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		
		<ul class="form-fields">
			<li>
				{{ Form::label('unique_id', 'Patient ID', array('class' => 'field-label-side')) }}
				{{ Form::text('unique_id', null, array('class' => 'textfield-mini', 'required', 'maxlength' => '10', 'pattern' => '\d+')) }}
			</li>
			<li class="button-side">
				{{ Form::submit('Submit') }}
			</li>
		</ul>
	{{ Form::close() }}
@stop