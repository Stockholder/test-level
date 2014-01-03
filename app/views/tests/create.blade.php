@extends('layouts.scaffold')

@section('main')

<h1>Create Test</h1>

{{ Form::open(array('route' => 'tests.store')) }}
	<ul>
        <li>
            {{ Form::label('description', 'Description:') }}
            {{ Form::text('description') }}
        </li>

        <li>
            {{ Form::label('languages_id', 'Languages_id:') }}
            {{ Form::select('languages_id', $languages_options); }}
            {{ link_to_route('languages.index', 'Add new', array(), array('class' => 'btn btn-info', 'target' => 'blank')) }}
        </li>

        <li>
            {{ Form::label('affiliates_id', 'Affiliates_id:') }}
            {{ Form::select('affiliates_id', $affiliates_options); }}
            {{ link_to_route('affiliates.index', 'Add new', array(), array('class' => 'btn btn-info', 'target' => 'blank')) }}
        </li>

        <li>
            {{ Form::label('active', 'Active:') }}
            {{ Form::checkbox('active') }}
        </li>

		<li>
			{{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


