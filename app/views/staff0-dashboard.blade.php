@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<nav>
		<ul>
			<li>Dashboard</li>
		</ul>
	</nav>
	
	{{ Form::open(array('url' => 'clinician')) }}
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		
		<ul class="form-fields">
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
			<table class="align-right">
				<tr>
					<td>Sensory Scale:</td>
					<td>{{ $survey->survey_scale0 }}</td>
				</tr>
				<tr>
					<td>Motor Scale:</td>
					<td>{{ $survey->survey_scale1 }}</td>
				</tr>
				<tr>
					<td>Autonomic Scale:</td>
					<td>{{ $survey->survey_scale2 }}</td>
				</tr>
				<tr>
					<td class="total">Total:</td>
					<td class="total">{{ $survey->survey_total }}</td>
				</tr>
			</table>
			
			<p>
				@if ($start)
					<a class="button-link" href="{{ URL::to('assessment') }}">Start a new assessment</a>
				@else
					A new assessment cannot be started at this time.
				@endif
			</p>
		@else
			<p>Patient has not completed a survey since the last assessment.</p>
		@endif
		
		@if (!$exams->isEmpty())
			<h2>Completed Assessments</h2>
			
			<table>
				<tr>
					<th>Score</th>
					<th>Completed On</th>
					<th class="no-border no-background"></th>
				</tr>
				@foreach ($exams as $exam)
					<tr>
						<td class="align-right">{{ $exam->assessment_total }}</td>
						<td>{{ date('F j, Y', strtotime($exam->updated_at)) }}</td>
						<td class="no-border no-background">
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