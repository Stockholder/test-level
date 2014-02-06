@extends('layouts.scaffold')

@section('main')

<h1>Edit Question</h1>
{{ Form::model($question, array('method' => 'PATCH', 'route' => array('questions.update', $question->id))) }}
	<ul>
        <li>
            {{ Form::label('description', 'Description:') }}
            {{ Form::text('description') }}
        </li>

        <li>
            {{ Form::label('audio_id', 'Audio_id:') }}
            {{ Form::input('number', 'audio_id') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('questions.show', 'Cancel', $question->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
