@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p>Staff, enter your UMICH uniquename to log in.</p>
	
	{{ Form::open(array('url' => 'staff-login')) }}
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		
		<ul class="form-fields">
			<li>
				{{ Form::text('unique_id', null, array('class' => 'textfield-short', 'placeholder' => 'Uniquename')) }}
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
	<div id="footer-login"><a href="{{ URL::to('login') }}">patient login</a></div>
@stop