@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('staff-logout') }}">Log out</a></p>
	<p><a href="{{ URL::to('/') }}">Dashboard</a></p>

	<h1>Add Research Staff</h1>
	
	{{ Form::open(array('url' => 'add-staff')) }}
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		
		<ul>
			<li>
				{{ Form::label('unique_id', 'Uniquename') }}
				{{ Form::text('unique_id', null, array('required', 'pattern' => '[a-z]+')) }}
			</li>
			<li>
				{{ Form::submit('Submit') }}
			</li>
		</ul>
	{{ Form::close() }}
@stop