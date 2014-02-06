@extends('layouts.scaffold')

@section('main')

<h1>Create Alternative</h1>

{{ Form::open(array('route' => 'alternatives.store')) }}
	<ul>
        <li>
            {{ Form::label('description', 'Description:') }}
            {{ Form::text('description') }}
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


