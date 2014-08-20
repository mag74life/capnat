@extends('layouts.master')

@section('head')
	@parent
	
	
@stop

@section('content')
	<nav>
		<ul>
			<li><a href="{{ URL::to('/') }}">Dashboard</a></li>
			<li><a href="{{ URL::to('research') }}">Research Data</a></li>
			<li>Patient #{{ $patient->id }}</li>
		</ul>
	</nav>
	
	<h1>Patient Data</h1>
	
	<table>
		<tr>
			<td class="align-right">Padient ID:</td>
			<td>{{ $patient->id }}</td>
		</tr>
		<tr>
			<td class="align-right">Name:</td>
			<td>{{ $patient->name }}</td>
		</tr>
		<tr>
			<td class="align-right">Date of Birth:</td>
			<td>{{ date('F j, Y', strtotime($patient->dob)) }}</td>
		</tr>
		<tr>
			<td class="align-right">Gender:</td>
			<td>{{ $patient->gender }}</td>
		</tr>
		<tr>
			<td class="align-right">Race:</td>
			<td>{{ $patient->race }}</td>
		</tr>
		<tr>
			<td class="align-right">Ethnicity:</td>
			<td>{{ $patient->ethnicity }}</td>
		</tr>
		<tr>
			<td class="align-right">Education:</td>
			<td>{{ $patient->education }}</td>
		</tr>
	</table>
	
	<h2>Exams for {{ $patient->name }}</h2>
	<table>
		<tr>
			<th>Completed On</th>
			<th>Survey Total</th>
			<th>Assessment Total</th>
			<th class="no-border no-background"></th>
		</tr>
		@foreach ($patient->exams as $exam)
			<tr>
				<td>{{ date('F j, Y', strtotime($exam->updated_at)) }}</td>
				<td class="align-right">{{ $exam->survey_total }}</td>
				<td class="align-right">{{ $exam->assessment_total !== null ? $exam->assessment_total : 'N/A' }}</td>
				<td class="no-border no-background"><a href="{{ URL::to('exam/' . $exam->id) }}">View</a></td>
			</tr>
		@endforeach
	</table>
	
@stop