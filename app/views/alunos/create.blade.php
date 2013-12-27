@extends('layouts.master')

@section('content')

<h1>Create Aluno</h1>

{{ Form::open(array('route' => 'alunos.store')) }}
<ul>
	<li>
		{{ Form::label('nome', 'Nome:') }}
		<br>
		{{ Form::text('nome') }}
	</li>
	<li>
		{{ Form::label('email', 'Email:') }}
		<br>
		{{ Form::text('email') }}
	</li>
	<li>
		{{Form::label('telefone', 'Telefone:') }}
		<br>
		{{ Form::text('telefone') }}
	</li>
	<li>&nbsp;</li>
	<li>
		{{Form::submit('Submit', array('class' => 'btn-info')) }}
	</li>
</ul>
{{ Form::close() }}

@if($errors->any())
<ul>
	{{ implode('', $errors->all('<li class="error">:message</li>')) }}
</ul>
@endif

@stop