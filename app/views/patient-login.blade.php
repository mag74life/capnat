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
		
		<ul class="form-fields">
			<li>
				{{ Form::text('unique_id', null, array('class' => 'textfield-short', 'maxlength' => '10', 'placeholder' => 'Patient ID')) }}
			</li>
			<li>
				{{ Form::password('password', array('class' => 'textfield-short', 'placeholder' => 'Password')) }}
			</li>
			<li>
				{{ Form::submit('Log in') }}
			</li>
		</ul>
	{{ Form::close() }}
@stop

@section('footer')
	<div id="footer-login"><a href="{{ URL::to('staff-login') }}">staff login</a></div>
@stop