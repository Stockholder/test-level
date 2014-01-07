@extends('layouts.alternate')

@section('main')

@if ($alternatives->count())
	<h4>All Alternatives</h4>
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Description</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($alternatives as $alternative)
				<tr>
					<td>{{{ $alternative->description }}}</td>
                    <td>{{ link_to_route('alternatives.edit', 'Edit', array($alternative->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('alternatives.destroy', $alternative->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no alternatives
@endif

@stop
