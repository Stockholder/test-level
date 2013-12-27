@extends('layouts.master')

@section('content')

<h1>Show Aluno</h1>

<p>{{ link_to_route('alunos.index', 'Return to all alunos') }}</p>

<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>	
			<th>Nome</th>
			<th>Email</th>
			<th>Telefone</th>
			<th colspan="2" style="text-align:center;">Actions</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>{{ $aluno->nome }}</td>
			<td>{{ $aluno->email }}</td>
			<td>{{ $aluno->telefone }}</td>
			<td>{{ link_to_route('alunos.edit', 'Edit', array($aluno->id), array('class' => 'btn btn-info')) }}</td>
			<td>
				{{ Form::open(array('method' => 'DELETE', 'route' => array('alunos.destroy', $aluno->id))) }}
					{{ Form::submit('delete', array('class', 'btn btn-danger')) }}
				{{ Form::close() }}
			</td>
		</tr>
	</tbody>
</table>

@stop