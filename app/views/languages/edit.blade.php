@extends('layouts.scaffold')

@section('main')

<h1>Edit Language</h1>
{{ Form::model($language, array('method' => 'PATCH', 'route' => array('languages.update', $language->id))) }}
	<ul>
        <li>
            {{ Form::label('language', 'Language:') }}
            {{ Form::text('language') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('languages.show', 'Cancel', $language->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
