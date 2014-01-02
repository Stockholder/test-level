@extends('layouts.scaffold')

@section('main')

<h1>Show Student</h1>

<p>{{ link_to_route('students.index', 'Return to all students') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Name</th>
				<th>Phone</th>
				<th>Email</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $student->name }}}</td>
					<td>{{{ $student->phone }}}</td>
					<td>{{{ $student->email }}}</td>
                    <td>{{ link_to_route('students.edit', 'Edit', array($student->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('students.destroy', $student->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
