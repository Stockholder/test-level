@extends('layouts.scaffold')

@section('main')

<h1>Edit Test</h1>
{{ Form::model($test, array('method' => 'PATCH', 'route' => array('tests.update', $test->id))) }}
	<ul>
        <li>
            {{ Form::label('description', 'Description:') }}
            {{ Form::text('description') }}
        </li>

        <li>
            {{ Form::label('languages_id', 'Languages_id:') }}
            {{ Form::select('languages_id', $languages_options); }}
        </li>

        <li>
            {{ Form::label('affiliates_id', 'Affiliates_id:') }}
            {{ Form::select('affiliates_id', $affiliates_options); }}
        </li>

        <li>
            {{ Form::label('active', 'Active:') }}
            {{ Form::checkbox('active') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('tests.show', 'Cancel', $test->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
