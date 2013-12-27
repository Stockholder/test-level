@extends('layouts.master')

@section('content')

<h1>All Alunos</h1>

<p>{{ link_to_route('alunos.create', 'Add new Aluno') }}</p>

@if ($alunos->count())
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>Nome</th>
				<th>Email</th>
				<th>Telefone</th>
				<th colspan="3" style="text-align:center;">Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach($alunos as $aluno)
			<tr>
				<td>{{ $aluno->nome }}</td>
				<td>{{ $aluno->email }}</td>
				<td>{{ $aluno->Telefone }}</td>
				<td>
					{{ link_to_route('alunos.show', 'Show', array($aluno->id), array('class' => 'btn btn-primary')) }}
				</td>
				<td>
					{{ link_to_route('alunos.edit', 'Edit', array($aluno->id), array(' class' => 'btn btn-info')) }}
				</td>
				<td>
					{{ Form::open(array('method' => 'DELETE', 'route' => array('alunos.destroy', $aluno->id))) }}
						{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no alunos
@endif

@stop