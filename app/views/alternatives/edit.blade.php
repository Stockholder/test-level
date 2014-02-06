@extends('layouts.scaffold')

@section('main')

<h1>Edit Alternative</h1>
{{ Form::model($alternative, array('method' => 'PATCH', 'route' => array('alternatives.update', $alternative->id))) }}
	<ul>
        <li>
            {{ Form::label('description', 'Description:') }}
            {{ Form::text('description') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('alternatives.show', 'Cancel', $alternative->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
