@extends('layouts.scaffold')

@section('main')

<h1>Create Affiliate</h1>

{{ Form::open(array('route' => 'affiliates.store')) }}
	<ul>
        <li>
            {{ Form::label('city', 'City:') }}
            {{ Form::text('city') }}
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


