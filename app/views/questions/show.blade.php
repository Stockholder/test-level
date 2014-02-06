@extends('layouts.scaffold')

@section('main')

<h1>Show Question</h1>

<p>{{ link_to_route('questions.index', 'Return to all questions') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Description</th>
				<th>Audio_id</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $question->description }}}</td>
					<td>{{{ $question->audio_id }}}</td>
                    <td>{{ link_to_route('questions.edit', 'Edit', array($question->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('questions.destroy', $question->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
