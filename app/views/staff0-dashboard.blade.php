@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<p><a href="{{ URL::to('staff-logout') }}">Log out</a></p>

	<p>This is the clinician dashboard.</p>
	
	{{ Form::open(array('url' => 'clinician')) }}
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		
		<ul>
			<li>
				<p>Select a patient by entering his or her ID.</p>
				{{ Form::text('unique_id', null, array('required', 'maxlength' => '10', 'pattern' => '\d+', 'placeholder' => 'Patient ID')) }} {{ Form::submit('Select') }}
			</li>
		</ul>
	{{ Form::close() }}
	
	@if (Session::get('patient') != null)
		<h1>{{ $name }}</h1>
		@if ($survey != null)
			<p>Patient completed last survey on {{ $survey->updated_at }}</p>
			<table>
				<tr>
					<td style="text-align: right;">Sensory Scale:</td>
					<td>{{ $survey->survey_scale0 }}</td>
				</tr>
				<tr>
					<td style="text-align: right;">Motor Scale:</td>
					<td>{{ $survey->survey_scale1 }}</td>
				</tr>
				<tr>
					<td style="text-align: right;">Autonomic Scale:</td>
					<td>{{ $survey->survey_scale2 }}</td>
				</tr>
				<tr>
					<td style="text-align: right;">Total:</td>
					<td>{{ $survey->survey_total }}</td>
				</tr>
			</table>
			
			<p>
				@if ($start)
					<a href="{{ URL::to('assessment') }}">Start a new assessment</a>
				@else
					A new assessment cannot be started at this time.
				@endif
			</p>
		@else
			<p>Patient has not completed a survey since the last assessment.</p>
		@endif
		
		@if (!$exams->isEmpty())
			<h2>Completed assessments:</h2>
			
			<table border="1">
				<tr>
					<th>Score</th>
					<th>Completed At</th>
					<th></th>
				</tr>
				@foreach ($exams as $exam)
					<tr>
						<td>{{ $exam->assessment_total }}</td>
						<td>{{ $exam->updated_at }}</td>
						<td>
							@if ($exam->id == $reviseExamId)
								<a href="{{ URL::to('assessment/revise') }}">Revise</a>
							@endif
						</td>
					</tr>
				@endforeach
			</table>
		@endif
	@endif
@stop