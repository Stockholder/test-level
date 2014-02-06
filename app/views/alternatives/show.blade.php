@extends('layouts.scaffold')

@section('main')

<h1>Show Alternative</h1>

<p>{{ link_to_route('alternatives.index', 'Return to all alternatives') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Description</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $alternative->description }}}</td>
                    <td>{{ link_to_route('alternatives.edit', 'Edit', array($alternative->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('alternatives.destroy', $alternative->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
