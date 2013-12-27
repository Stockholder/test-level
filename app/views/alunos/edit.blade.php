@extends('layouts.master')

@section('content')

<h1>Edit Aluno</h1>
{{ Form::model($aluno, array('method' => 'PATCH', 'route' => array('alunos.update', $aluno->id))) }}

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
		{{ Form::label('telefone', 'Telefone:') }}
		<br>
		{{ Form::text('telefone') }}
	</li>
	<li>&nbsp;</li>
	<li>
		{{ Form::submit('Update', array('class' => 'btn-success')) }}
		{{ link_to_route('alunos.show', 'Cancel', $aluno->id, array('class' => 'btn btn-warning')) }}
	</li>
</ul>
{{ Form::close() }}

@if($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop