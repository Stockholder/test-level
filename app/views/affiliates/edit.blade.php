@extends('layouts.scaffold')

@section('main')

<h1>Edit Affiliate</h1>
{{ Form::model($affiliate, array('method' => 'PATCH', 'route' => array('affiliates.update', $affiliate->id))) }}
	<ul>
        <li>
            {{ Form::label('city', 'City:') }}
            {{ Form::text('city') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('affiliates.show', 'Cancel', $affiliate->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
