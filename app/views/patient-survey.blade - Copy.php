@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
<pre><?php var_dump($newest); ?></pre>

	<p><a href="{{ URL::to('logout') }}">Log out</a></p>
	<p><a href="{{ URL::to('/') }}">Dashboard</a></p>

	<h1>Survey</h1>
	
	{{ Form::open(array('url' => 'survey')) }}
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		
		<ul>
			@for ($i = 0; $i < Config::get('app.surveyLength'); $i++)
				<li>
					<p>{{ $survey->questions[$i]->question }}</p>
					<ol>
						@for ($j = 0; $j < count($survey->choices); $j++)
							<li>{{ Form::radio('q' . $i, $j, null, array('id' => 'q' . $i . '-' . $j)) }} {{ Form::label('q' . $i . '-' . $j, $survey->choices[$j]) }}</li>
						@endfor
					</ol>
				</li>
			@endfor
			<li>
				{{ Form::submit('Submit') }}
			</li>
		</ul>
	{{ Form::close() }}
@stop