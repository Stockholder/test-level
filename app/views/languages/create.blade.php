@extends('layouts.scaffold')

@section('main')

<h1>Create Language</h1>

{{ Form::open(array('route' => 'languages.store')) }}
	<ul>
        <li>
            {{ Form::label('language', 'Language:') }}
            {{ Form::text('language') }}
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


